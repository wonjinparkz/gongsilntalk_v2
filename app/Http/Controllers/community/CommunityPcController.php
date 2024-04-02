<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Magazine;
use App\Models\Notice;
use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 커뮤니티 관리자
|--------------------------------------------------------------------------
|
| - 커뮤니티 목록 관리
|       - 커뮤니티 목록 보기 (O)
|       - 커뮤니티 상세 보기 (O)
|       - 댓글 보기 (O)
|       - 커뮤니티 상태 수정 (O)
|
*/

class CommunityPcController extends Controller
{

    public function communityListView(Request $request): View
    {
        $is_community = $request->community ?? 0;
        $tableName = $is_community == 0 ? "magazine" : "community";

        if ($is_community == 0) {

            // 매거진
            $communityList = Magazine::select()->withCount('replys')
                ->select(
                    'magazine.*'
                )
                ->where('magazine.type', '=', $request->type ?? 0)
                ->where('magazine.is_blind', '0');
        } else if ($is_community == 1) {

            // 커뮤니티
            $communityList = Community::select()->withCount('replys')
                ->select(
                    'community.*',
                )
                ->where('community.category', '=', $request->type ?? 0)
                ->where('community.is_blind', '0')
                ->where('community.is_delete', '0');
        }
        if ($is_community == 0) {
            $communityList->like($tableName, Magazine::class, Auth::guard('web')->user()->id ?? "");
        } else {
            if (Auth::guard('web')->user() != null) {
                $communityList->like($tableName, Community::class, Auth::guard('web')->user()->id ?? "");
                $communityList->report($tableName, Community::class, Auth::guard('web')->user()->id ?? "");
                $communityList->block($tableName, Auth::guard('web')->user()->id ?? "");
            }
        }

        // 정렬
        if ($request->order == 1) {
            $communityList->orderBy($tableName . '.like_count', 'desc')->orderBy($tableName . '.id', 'desc');
        } else if ($request->order == 2) {
            $communityList->orderBy('replys_count', 'desc')->orderBy($tableName . '.id', 'desc');
        } else {
            $communityList->orderBy($tableName . '.created_at', 'desc')->orderBy($tableName . '.id', 'desc');
        }

        // 페이징
        $result = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);

        $noticeList = Notice::select()->where('is_blind', '0')->get();

        return view('www.community.community_list', compact('result', 'noticeList'));
    }

    /**
     * 커뮤니티 등록 화면 조회
     */
    public function communityDetailView(): View
    {
        return view('www.community.community_detail');
    }

    /**
     * 커뮤니티 등록 화면 조회
     */
    public function communityCreateView(): View
    {
        return view('www.community.community_create');
    }


    /**
     * 매거진 등록
     */
    public function communityCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required|min:1|max:50',
            'content' => 'required',
            'community_image_ids' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Community::create([
            'author' => Auth::guard('web')->user()->id,
            'category' => $request->category,
            'title' => $request->title,
            'content' => $request->content,
            'is_blind' => 0, // 등록 시에는 0
            'view_count' => 0, // 등록 시에는 0 조회 할 때 증가,
            'like_count' => 0, // 등록 시에는 0 좋아요 할 때 증가,
            'is_delete' => 0,
        ]);

        $this->imageWithCreate($request->community_image_ids, Community::class, $result->id);


        return Redirect::route('www.community.detail.view', [$result->id])->with('message', '게시글을 등록했습니다.');
    }
}

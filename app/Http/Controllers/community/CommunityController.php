<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\CommunityCategory;
use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

class CommunityController extends Controller
{
    /**
     * 커뮤니티 목록 보기
     */
    public function listView(Request $request): View
    {

        // 커뮤니티 선택
        $communityList = Community::select(
            'community.*',
            'users.nickname AS author_nickname',
        )
            ->where('community.is_delete', '0');


        $communityList->join('users', 'community.author', '=', 'users.id');

        // 검색어
        if (isset($request->title)) {
            $communityList
                ->where('community.title', 'like', "%{$request->title}%");
        }

        // 카테고리
        if ($request->has('category')) {
            $categoryArray = $request->category;
            $communityList->whereIn('community.category', $categoryArray);
        }

        // 작성자 닉네임
        if (isset($request->author_nickname)) {
            $communityList
                ->where('users.nickname', 'like', "%{$request->author_nickname}%");
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $communityList->DurationDate('community.created_at', $request->from_created_at, $request->to_created_at);
        }
        // 정렬
        $communityList->orderBy('community.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징 처리
        $result = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));

        return view('admin.community.community-list', compact('result'));
    }

    /**
     * 커뮤니티 상세보기
     */
    public function detailView(Request $request): View
    {

        $result = Community::select(
            'community.*',
            'users.nickname As author_nickname',
        )
            ->join('users', 'community.author', '=', 'users.id')
            ->where('community.id', $request->id)
            ->first();


        // 커뮤니티 댓글 선택
        $ReplyList = Reply::with('rereplies')->select(
            'reply.*',
            'users.nickname AS author_name',
            'users.type AS author_type',
        );

        // 작성자
        $ReplyList->join('users', 'reply.author', '=', 'users.id');

        // 해당 댓글만
        $ReplyList->where('reply.target_id', '=', $request->id);
        $ReplyList->where('reply.target_type', '=', 'community');

        // 작성자 닉네임
        if (isset($request->author_nickname)) {
            $ReplyList->where('users.nickname', 'like', "%{$request->author_nickname}%");
        }

        // 정렬
        if ($request->has('member_type') && $request->member_type == 1) {
            $ReplyList->where('users.type', '=', "$request->member_type");
        }


        // 댓글일 경우만
        $ReplyList->whereNull('parent_id');

        // 정렬
        if ($request->has('orderBy') && $request->orderBy == 1) {
            $ReplyList->orderBy('reply.report_count', 'DESC')->orderBy('id', 'DESC');
        } else {
            $ReplyList->orderBy('reply.created_at', 'DESC')->orderBy('id', 'DESC');
        }

        // 페이징 처리
        $replys = $ReplyList->paginate($request->per_page == null ? 10 : $request->per_page);
        $replys->appends(request()->except('page'));



        return view('admin.community.community-detail', compact('result', 'replys'));
    }


    /**
     * 커뮤니티 상태 수정
     */
    public function updateState(Request $request): RedirectResponse
    {
        $result = Community::where('id', $request->id)
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '게시글 게시상태를 수정했습니다.');
    }

    /**
     * 커뮤니티 댓글 상태 수정
     */
    public function replyUpdateState(Request $request): RedirectResponse
    {
        $result = Reply::where('id', $request->id)
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '댓글 게시상태를 수정했습니다.');
    }
}

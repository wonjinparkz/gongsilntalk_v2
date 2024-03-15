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
            - 댓글 보기 (O)
|       - 커뮤니티 등록 화면
|       - 커뮤니티 등록
|       - 커뮤니티 수정 (O)
|       - 커뮤니티 상태 수정
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
            'users.name AS author_name',
            'community_category.title AS category_title'
        );

        // 관리자 조인 -> 작성자가 필요할까?
        $communityList->join('users', 'community.author', '=', 'users.id');
        $communityList->join('community_category', 'community.category_id', '=', 'community_category.id');

        // 검색어
        if (isset($request->title)) {
            $communityList
                ->where('community.title', 'like', "%{$request->title}%")
                ->orWhere('community.content', 'like', "%{$request->title}%");
        }

        // 카테고리
        if (isset($request->category)) {
            $communityList->where('community.category_id', '=', $request->category);
        }

        // 상태
        if ($request->has('state') && $request->state > -1) {
            $communityList->where('community.state', '=', $request->state);
        }

        // 작성일 from-date
        if (isset($request->from_created_at)) {
            $communityList->whereDate('community.created_at', '>=', date($request->from_created_at));
        }

        // 작성일 to-date
        if (isset($request->to_created_at)) {
            $communityList->whereDate('community.created_at', '<=', date($request->to_created_at));
        }

        // 정렬
        $communityList->orderBy('community.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징 처리
        $result = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));


        // 커뮤니티 카테고리
        $categoryList = CommunityCategory::select();
        // 정렬
        $categoryList->orderBy('id', 'asc');

        $categoryResult = $categoryList->get();

        return view('admin.community.community-list', compact('result', 'categoryResult'));
    }

    /**
     * 커뮤니티 상세보기
     */
    public function detailView(Request $request): View
    {

        $result = Community::where('id', $request->id)->first();


        // 커뮤니티 댓글 선택
        $ReplyList = Reply::with('rereplies')->select(
            'reply.*',
            'users.name AS author_name',
        );

        // 작성자
        $ReplyList->join('users', 'reply.author', '=', 'users.id');

        // 해당 댓글만
        $ReplyList->where('reply.target_id', '=', $request->id);

        if (isset($request->content)) {
            $ReplyList->where('reply.content', 'like', "%{$request->content}%");
        }

        // 작성일 from-date
        if (isset($request->from_created_at)) {
            $ReplyList->whereDate('reply.created_at', '>=', date($request->from_created_at));
        }

        // 작성일 to-date
        if (isset($request->to_created_at)) {
            $ReplyList->whereDate('reply.created_at', '<=', date($request->to_created_at));
        }

        // 댓글일 경우만
        $ReplyList->whereNull('parent_id');

        // 정렬
        $ReplyList->orderBy('reply.created_at', 'asc')->orderBy('id', 'asc');



        // 페이징 처리
        $replys = $ReplyList->paginate($request->per_page == null ? 10 : $request->per_page);
        $replys->appends(request()->except('page'));



        return view('admin.community.community-detail', compact('result', 'replys'));
    }

    /**
     * 커뮤니티 수정
     */
    public function update(Request $request): RedirectResponse
    {

        // 오류 체크
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:community_category,id',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.community.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = Community::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'state' => $request->state,
            ]);

        return redirect()->to($request->lasturl)->with('message', '커뮤니티 게시글을 수정했습니다.');
    }

    /**
     * 커뮤니티 상태 수정
     */
    public function updateState(Request $request): RedirectResponse
    {
        $result = Community::where('id', $request->id)
            ->update(['state' => $request->state == 0 ? 1 : 0]);

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

<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use App\Models\CommunityCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
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
| - 커뮤니티 카테고리 관리
|       - 커뮤니티 카테고리 목록 보기 (O)
|       - 커뮤니티 카테고리 상세 보기 (O)
|       - 커뮤니티 카테고리 등록 화면 (O)
|       - 커뮤니티 카테고리 등록 (O)
|       - 커뮤니티 카테고리 수정 (O)
|       - 커뮤니티 카테고리 상태 수정 (O)
|       - 커뮤니티 카테고리 삭제 (O)
|
*/

class CommunityCategoryController extends Controller
{
    /**
     * 커뮤니티 카테고리 목록 보기
     */
    public function listView(Request $request): View
    {

        $categoryList = CommunityCategory::select();

        // 관리자 조인 -> 작성자가 필요할까?
        //  $categoryList->join('admins', 'community_category.author', '=', 'admins.id');

        // 검색어
        if (isset($request->title)) {
            $categoryList
                ->where('community_category.title', 'like', "%{$request->title}%")
                ->orWhere('community_category.content', 'like', "%{$request->title}%");
        }

        // 상태
        if ($request->has('state') && $request->state > -1) {
            $categoryList->where('community_category.state', '=', $request->state);
        }

        // 작성일 from-date
        if (isset($request->from_created_at)) {
            $categoryList->whereDate('community_category.created_at', '>=', date($request->from_created_at));
        }

        // 작성일 to-date
        if (isset($request->to_created_at)) {
            $categoryList->whereDate('community_category.created_at', '<=', date($request->to_created_at));
        }

        // 정렬
        $categoryList->orderBy('community_category.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징 처리
        $result = $categoryList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));


        return view('admin.community.community-category-list', compact('result'));
    }

    /**
     * 커뮤니티 카테고리 상세 화면 보기
     */
    public function detailView($id): View
    {
        $result = CommunityCategory::where('id', $id)->first();
        return view('admin.community.community-category-detail', compact('result'));
    }


    /**
     * 커뮤니티 카테고리 등록 화면 조회
     */
    public function createView(): View
    {
        return view('admin.community.community-category-add');
    }

    /**
     * 커뮤니티 카테고리 등록
     */
    public function create(Request $request): RedirectResponse
    {

        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:10',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.community.category.create.view'))
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = CommunityCategory::create([
            'title' => $request->title,
            'content' => $request->content,
            'state' => $request->state, // 등록 시에는 0
        ]);


        $this->imageWithCreate($request->category_image_ids, CommunityCategory::class, $result->id);
        $this->fileWithCreate($request->category_file_ids, CommunityCategory::class, $result->id);

        return Redirect::route('admin.community.category.list.view')->with('message', '카테고리를 등록했습니다.');
    }

    /**
     * 커뮤니티 카테고리 수정
     */
    public function update(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:10',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.community.category.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = CommunityCategory::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'state' => $request->state,
            ]);

        $this->imageWithEdit($request->category_image_ids, CommunityCategory::class, $request->id);
        $this->fileWithEdit($request->category_file_ids, CommunityCategory::class, $request->id);

        return redirect()->to($request->lasturl)->with('message', '카테고리를 수정했습니다.');
    }


    /**
     * 커뮤니티 카테고리 상태 수정
     */
    public function updateState(Request $request): RedirectResponse
    {
        $result = CommunityCategory::where('id', $request->id)
            ->update(['state' => $request->state == 0 ? 1 : 0]);

        return back()->with('message', '카테고리 게시상태를 수정했습니다.');
    }

    /**
     * 커뮤니티 카테고리 삭제
     */
    public function delete(Request $request): RedirectResponse
    {
        $result = CommunityCategory::where('id', $request->id)->delete();
        return back()->with('message', '카테고리를 삭제했습니다.');
    }
}

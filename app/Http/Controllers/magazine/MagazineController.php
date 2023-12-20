<?php

namespace App\Http\Controllers\magazine;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\MagazineCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 매거진 관리자
|--------------------------------------------------------------------------
|
| - 매거진 목록 관리
|       - 매거진 목록 보기
|       - 매거진 상세 보기
            - 댓글 보기
|       - 매거진 등록 화면
|       - 매거진 등록
|       - 매거진 수정
|       - 매거진 상태 수정
|
*/

class MagazineController extends Controller
{
    /**
     * 매거진 목록 보기
     */
    public function magazineListView(Request $request): View
    {
        $magazineList = Magazine::with('images')->with('category')->select();

        // 검색어
        if (isset($request->title)) {
            $magazineList
                ->where('title', 'like', "%{$request->title}%")
                ->orWhere('content', 'like', "%{$request->title}%");
        }

        // 생성일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $magazineList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 상태
        if (isset($request->is_blind)) {
            $magazineList->where('is_blind', '=', $request->is_blind);
        }

        if (isset($request->magazine_category_id)) {
            $magazineList->where('magazine_category_id', '=', $request->magazine_category_id);
        }

        // 정렬
        $magazineList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        // 페이징
        $result = $magazineList->paginate($request->per_page == null ? 10 : $request->per_page);

        $categoryList = MagazineCategory::where('is_blind', 0)->get();

        return view('admin.magazine.magazine-list', compact('result', 'categoryList'));
    }

    /**
     * 매거진 상세 화면 보기
     */
    public function magazineDetailView(Request $request): View
    {
        $result = Magazine::with('images')->where('id', $request->id)->first();
        $categoryList = MagazineCategory::where('is_blind', 0)->get();

        return view('admin.magazine.magazine-detail', compact('result', 'categoryList'));
    }

    /**
     * 매거진 등록 화면 보기
     */
    public function magazineCreateView(): View
    {

        $categoryList = MagazineCategory::where('is_blind', 0)->get();

        return view('admin.magazine.magazine-create', compact('categoryList'));
    }

    /**
     * 매거진 등록
     */
    public function magazineCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
            'magazine_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Magazine::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'magazine_category_id' => $request->magazine_category_id,
            'is_blind' => $request->is_blind, // 등록 시에는 0
            'view_count' => 0, // 등록 시에는 0 조회 할 때 증가,
        ]);

        $this->imageWithCreate($request->magazine_image_ids, Magazine::class, $result->id);


        return Redirect::route('admin.magazine.list.view')->with('message', '매거진을 등록했습니다.');
    }

    /**
     * 매거진 수정
     */
    public function magazineUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
            'magazine_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Magazine::where('id', $request->id)->first()
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'magazine_category_id' => $request->magazine_category_id,
                'is_blind' => $request->is_blind,
            ]);

        $this->imageWithEdit($request->magazine_image_ids, Magazine::class, $request->id);

        return redirect()->to($request->last_url)->with('message', '매거진을 수정했습니다.');
    }

    /**
     * 매거진 상태 수정
     */
    public function magazineStateUpdate(Request $request): RedirectResponse
    {
        $result = Magazine::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);
        return back()->with('message', '매거진 게시상태를 수정했습니다.');
    }

    /**
     * 매거진 삭제
     */
    public function magazineDelete(Request $request): RedirectResponse
    {
        $result = Magazine::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '매거진을 삭제했습니다.');
    }
}

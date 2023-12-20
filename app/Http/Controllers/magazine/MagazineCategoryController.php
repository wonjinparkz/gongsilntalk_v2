<?php

namespace App\Http\Controllers\magazine;

use App\Http\Controllers\Controller;
use App\Models\MagazineCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 매거진 관리자
|--------------------------------------------------------------------------
|
| - 매거진 카테고리 관리
|       - 매거진 카테고리 목록 보기
|       - 매거진 등록
|       - 매거진 수정
|       - 매거진 상태 수정
|
*/

class MagazineCategoryController extends Controller
{

    /**
     * 매거진 카테고리 목록 보기
     */
    public function magazineCategoryListView(): View
    {
        $magazineCategoryList = MagazineCategory::select();
        $result = $magazineCategoryList->orderBy('order', 'asc')->get();
        return view('admin.magazine.category-list', compact('result'));
    }

    /**
     * 매거진 카테고리 생성
     */
    public function magazineCategoryCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:25|unique:magazine_category,title',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $order = MagazineCategory::max('order');
        $order = $order + 1;


        MagazineCategory::create([
            'title' => $request->title,
            'is_blind' => 0,
            'order' => $order
        ]);

        return Redirect::route('admin.magazine.category.list.view')->with('message', '매거진 카테고리를 추가했습니다.');
    }

    /**
     * 매거진 카테고리 순서 수정
     */
    public function magazineCategoryOrderUpdate(Request $request): RedirectResponse
    {


        $validator = Validator::make($request->all(), [
            "id" => "required|array",
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // 업데이트 여러개
        $count = count($request->category);
        for ($i = 0; $i < $count; $i++) {
            MagazineCategory::where('id', $request->id[$i])->update([
                'order' => ($i + 1)
            ]);
        }

        return Redirect::route('admin.magazine.category.list.view')->with('message', '매거진 상태를 수정했습니다.');
    }

    /**
     * 매거진 카테고리 제목 수정
     */
    public function magazineCategoryTitleUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'categoryTitle' => 'required|min:1|max:25|unique:magazine_category,title,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = MagazineCategory::where('id', $request->id)->first()
            ->update([
                'title' => $request->categoryTitle
            ]);


        return Redirect::route('admin.magazine.category.list.view')->with('message', '매거진 카테고리를 수정했습니다.');
    }

    /**
     * 매거진 카테고리 공개 설정 수정
     */
    public function magazineCategoryStateUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = MagazineCategory::where('id', $request->id)->first()
            ->update([
                'is_blind' => $request->categoryState == 0 ? 1 : 0
            ]);


        return Redirect::route('admin.magazine.category.list.view')->with('message', '매거진 상태를 수정했습니다.');
    }
}

<?php

namespace App\Http\Controllers\maintext;

use App\Http\Controllers\Controller;
use App\Models\MainText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 텍스트 관리자
|--------------------------------------------------------------------------
|
| - 텍스트 카테고리 관리
|       - 텍스트 카테고리 목록 보기
|       - 텍스트 등록
|       - 텍스트 수정
|       - 텍스트 상태 수정
|
*/

class MainTextController extends Controller
{

    /**
     * 텍스트 카테고리 목록 보기
     */
    public function mainTextListView(): View
    {
        $maintextList = MainText::select();
        $result = $maintextList->orderBy('order', 'asc')->get();
        return view('admin.mainText.mainText-list', compact('result'));
    }

    /**
     * 텍스트 카테고리 생성
     */
    public function mainTextCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:25|unique:main_text,title',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $order = MainText::max('order');
        $order = $order + 1;


        MainText::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'order' => $order
        ]);

        return Redirect::route('admin.main.text.list.view')->with('message', '텍스트 카테고리를 추가했습니다.');
    }

    /**
     * 텍스트 카테고리 순서 수정
     */
    public function mainTextOrderUpdate(Request $request): RedirectResponse
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
            MainText::where('id', $request->id[$i])->update([
                'order' => ($i + 1)
            ]);
        }

        return Redirect::route('admin.main.text.list.view')->with('message', '텍스트 상태를 수정했습니다.');
    }

    /**
     * 텍스트 카테고리 제목 수정
     */
    public function mainTextTitleUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'mainText' => 'required|min:1|max:25|unique:main_text,title,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = MainText::where('id', $request->id)->first()
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->mainText
            ]);


        return Redirect::route('admin.main.text.list.view')->with('message', '텍스트 카테고리를 수정했습니다.');
    }

    /**
     * 텍스트 카테고리 공개 설정 수정
     */
    public function mainTextStateUpdate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = MainText::where('id', $request->id)->first()
            ->update([
                'is_blind' => $request->categoryState == 0 ? 1 : 0
            ]);


        return Redirect::route('admin.main.text.list.view')->with('message', '텍스트 상태를 수정했습니다.');
    }


    /**
     * 메인 텍스트 삭제
     */
    public function mainTextDelete(Request $request): RedirectResponse
    {
        $result = MainText::where('id', $request->deleteId)->first()
            ->delete();
        return back()->with('message', '텍스트를 삭제했습니다.');
    }
}

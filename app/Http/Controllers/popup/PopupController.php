<?php

namespace App\Http\Controllers\popup;

use App\Http\Controllers\Controller;
use App\Models\Popups;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| 팝업 관리자
|--------------------------------------------------------------------------
|
| - 팝업 목록 보기 (O)
| - 팝업 상세 화면 보기 (O)
| - 팝업 등록 화면 조회 (O)
| - 팝업 등록 (O)
| - 팝업 수정 (O)
| - 팝업 게시 상태 수정 (O)
| - 팝업 삭제 (O)
|
*/

class PopupController extends Controller
{
    /**
     * 팝업 목록 보기
     */
    public function popupListView(Request $request): View
    {
        $popupList = Popups::with('images')->select();

        // 검색어
        if (isset($request->name)) {
            $popupList->where('popups.name', 'like', "%{$request->name}%");
        }

        // 팝업 상태
        if (isset($request->is_blind)) {
            $popupList->where('popups.is_blind', $request->is_blind);
        }

        // 타겟 유형
        if (isset($request->type)) {
            $popupList->where('popups.type', $request->type);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $popupList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $popupList->orderBy('popups.created_at', 'desc')->orderBy('id', 'desc');

        $result = $popupList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.popup.popup-list', compact('result'));
    }

    /**
     * 팝업관리 상세 화면 보기
     */
    public function popupDetailView($id): View
    {
        $result = Popups::with('images')->where('id', $id)->first();
        return view('admin.popup.popup-detail', compact('result'));
    }


    /**
     * 팝업관리 등록 화면 조회
     */
    public function popupCreateView(): View
    {
        return view('admin.popup.popup-create');
    }

    /**
     * 팝업관리 등록
     */
    public function popupCreate(Request $request): RedirectResponse
    {

        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:50',
            'popup_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.popup.create.view'))
                ->withErrors($validator)
                ->withInput();
        }


        $order = Popups::max('order');
        $order = $order + 1;

        // DB 추가
        $result = Popups::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'order' => $order,
            'name' => $request->name,
            'type' => $request->type,
            'url' => $request->url,
            'is_blind' => $request->is_blind,
        ]);

        $this->imageWithCreate($request->popup_image_ids, Popups::class, $result->id);


        return Redirect::route('admin.popup.list.view')->with('message', '팝업을 등록했습니다.');
    }


    /**
     * 팝업상세 수정
     */
    public function popupUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:50',
            'popup_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.popup.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = Popups::where('id', $request->id)
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'url' => $request->url,
                'is_blind' => $request->is_blind,
            ]);

        $this->imageWithEdit($request->popup_image_ids, Popups::class, $request->id);

        return redirect()->to($request->last_url)->with('message', '팝업 내용을 수정했습니다.');
    }

    /**
     * 팝업 게시상태 수정
     */
    public function popupStateUpdate(Request $request): RedirectResponse
    {
        $result = Popups::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '팝업 게시상태를 수정했습니다.');
    }

    /**
     * 팝업 삭제
     */
    public function popupDelete(Request $request): RedirectResponse
    {
        $result = Popups::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '팝업을 삭제했습니다.');
    }

    /**
     * 팝업 순서 변경
     */
    public function popupOrderUpdate(Request $request): RedirectResponse
    {
        $order_data = json_decode($request->order_data, true); // JSON 문자열을 PHP 배열로 변환

        // #1 노출순서를 바꾸는 팝업들 널값으로 변경 후에
        foreach ($order_data as $key => $value) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            Popups::where('id', '=', $key)->update([
                'order' => null,
            ]);
        }

        // #2 중복된 값이 있는지 체크 후에
        foreach ($order_data as $key => $value) {
            $popupList =  Popups::where('order', $value)->get();
        }

        // #3 중복된 값이 있을 경우 롤백 작업
        if ($popupList->count() > 1) {
            DB::rollBack();

            return back()->with('error', '팝업 순서가 중복됩니다.');
        } else {

            // #4 중복된 값이 없을 경우 순서 수정
            foreach ($order_data as $key => $value) {
                Popups::where('id', $key)
                    ->update([
                        'order' => $value > 0 ? $value : null,
                    ]);
            }
        }

        return back()->with('message', '팝업 순서를 수정했습니다.');
    }
}

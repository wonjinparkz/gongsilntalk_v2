<?php

namespace App\Http\Controllers\popup;

use App\Http\Controllers\Controller;
use App\Models\Popups;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
        if (isset($request->title)) {
            $popupList
                ->where('popups.title', 'like', "%{$request->title}%")
                ->orWhere('popups.content', 'like', "%{$request->title}%");
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
        if (isset($request->from_started_at) && isset($request->to_started_at)) {
            $popupList->DurationDate('popups.started_at', $request->from_started_at, $request->to_started_at);
        }

        // 게시 종료일 from ~ to
        if (isset($request->from_ended_at) && isset($request->to_ended_at)) {
            $popupList->DurationDate('popups.ended_at', $request->from_ended_at, $request->to_ended_at);
        }

        // 정렬
        $popupList->orderBy('popups.created_at', 'desc')->orderBy('id', 'desc');

        $result = $popupList->paginate($request->per_page == null ? 10 : $request->per_page);

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
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.popup.create.view'))
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Popups::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'started_at' => date($request->started_at),
            'ended_at' => date($request->ended_at),
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
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.popup.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = Popups::where('id', $request->id)
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'started_at' => date($request->started_at),
                'ended_at' => date($request->ended_at),
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
}

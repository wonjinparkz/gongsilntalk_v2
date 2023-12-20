<?php

namespace App\Http\Controllers\banner;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Route;


/*
|--------------------------------------------------------------------------
| 배너 관리자
|--------------------------------------------------------------------------
|
| - 배너 목록 보기 (O)
| - 배너 상세 화면 보기 (O)
| - 배너 등록 화면 조회 (O)
| - 배너 등록  (P) - 이미지 처리
| - 배너 수정 (P) - 이미지 처리
| - 배너 상태 수정 (O)
| - 배너 삭제 (O)
|
*/

class BannerController extends Controller
{
    /**
     * 배너 목록 보기
     */
    public function bannerListView(Request $request): View
    {
        $bannerList = Banners::with('images')->select();

        // 검색어
        if (isset($request->title)) {
            $bannerList
                ->where('banners.title', 'like', "%{$request->title}%")
                ->orWhere('banners.content', 'like', "%{$request->title}%");
        }

        // 타겟 유형
        if (isset($request->type)) {
            $bannerList->where('banners.type', $request->type);
        }

        // 배너 상태
        if (isset($request->is_blind)) {
            $bannerList->where('banners.is_blind', $request->is_blind);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_started_at) && isset($request->to_started_at)) {
            $bannerList->DurationDate('banners.started_at', $request->from_started_at, $request->to_started_at);
        }

        // 게시 종료일 from ~ to
        if (isset($request->from_ended_at) && isset($request->to_ended_at)) {
            $bannerList->DurationDate('banners.ended_at', $request->from_ended_at, $request->to_ended_at);
        }

        // 정렬
        $bannerList->orderBy('banners.created_at', 'desc')->orderBy('id', 'desc');

        $result = $bannerList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.banner.banner-list', compact('result'));
    }

    /**
     * 배너 상세 화면 보기
     */
    public function bannerDetailView($id): View
    {
        $result = Banners::where('id', $id)->first();
        return view('admin.banner.banner-detail', compact('result'));
    }

    /**
     * 배너 등록 화면 조회
     */
    public function bannerCreateView(): View
    {
        return view('admin.banner.banner-create');
    }

    /**
     * 배너 등록
     */
    public function bannerCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',

	    ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Banners::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'started_at' => date($request->started_at),
            'ended_at' => date($request->ended_at),
            'is_blind' => $request->is_blind,
        ]);

        $this->imageWithCreate($request->banner_image_ids, Banners::class, $result->id);

        return Redirect::route('admin.banner.list.view')->with('message', '배너를 등록했습니다.');
    }

    /**
     * 배너 수정
     */
    public function bannerUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Banners::where('id', $request->id)
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'is_blind' => $request->is_blind,
                'started_at' => date($request->started_at),
                'ended_at' => date($request->ended_at),
            ]);

        $this->imageWithEdit($request->banner_image_ids, Banners::class, $request->id);


        return redirect()->to($request->lasturl)->with('message', '배너를 수정했습니다.');
    }

    /**
     * 배너 상태수정
     */
    public function bannerStateUpdate(Request $request): RedirectResponse
    {
        $result = Banners::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '배너 게시상태를 수정했습니다.');
    }

    /**
     * 배너 삭제
     */
    public function bannerDelete(Request $request): RedirectResponse
    {
        $result = Banners::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '배너를 삭제했습니다.');
    }
}

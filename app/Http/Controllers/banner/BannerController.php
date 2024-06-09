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
        if (isset($request->is_sale)) {
            $bannerList->where('banners.is_sale', "$request->is_sale");
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $bannerList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }



        // 정렬
        $bannerList->orderBy('banners.created_at', 'desc')->orderBy('id', 'desc');

        $result = $bannerList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

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
            'name' => 'required|min:1|max:50',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:80',
            'banner_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $order = Banners::max('order');
        $order = $order + 1;

        // DB 추가
        $result = Banners::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'order' => $order,
            'name' => $request->name,
            'title' => $request->title,
            'content' => $request->content,
            'is_blind' => $request->is_blind,
            'url' => $request->url,
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
            'name' => 'required|min:1|max:50',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:80',
            'banner_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Banners::where('id', $request->id)
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
                'title' => $request->title,
                'content' => $request->content,
                'is_blind' => $request->is_blind,
                'url' => $request->url,
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

    /**
     * 배너 순서 변경
     */
    public function bannerOrderUpdate(Request $request): RedirectResponse
    {
        $order_data = json_decode($request->order_data, true); // JSON 문자열을 PHP 배열로 변환

        // #1 노출순서를 바꾸는 배너들 널값으로 변경 후에
        foreach ($order_data as $key => $value) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            Banners::where('id', '=', $key)->update([
                'order' => null,
            ]);
        }

        // #2 중복된 값이 있는지 체크 후에
        foreach ($order_data as $key => $value) {
            $bannersList =  Banners::where('order', $value)->get();
        }

        // #3 중복된 값이 있을 경우 롤백 작업
        if ($bannersList->count() > 1) {
            DB::rollBack();

            return back()->with('error', '배너 순서가 중복됩니다.');
        } else {

            // #4 중복된 값이 없을 경우 순서 수정
            foreach ($order_data as $key => $value) {
                Banners::where('id', $key)
                    ->update([
                        'order' => $value > 0 ? $value : null,
                    ]);
            }
        }

        return back()->with('message', '배너 순서를 수정했습니다.');
    }
}

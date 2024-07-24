<?php

namespace App\Http\Controllers\service;

use App\Http\Controllers\Controller;
use App\Models\Service;
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
| 서비스 관리자
|--------------------------------------------------------------------------
|
| - 서비스 목록 보기 (O)
| - 서비스 상세 화면 보기 (O)
| - 서비스 등록 화면 조회 (O)
| - 서비스 등록  (P) - 이미지 처리
| - 서비스 수정 (P) - 이미지 처리
| - 서비스 상태 수정 (O)
| - 서비스 삭제 (O)
|
*/

class ServiceController extends Controller
{
    /**
     * 서비스 목록 보기
     */
    public function serviceListView(Request $request): View
    {
        $serviceList = Service::with('images')->select()
            ->where('type', '=', 0);

        // 검색어
        if (isset($request->name)) {
            $serviceList->where('service.name', 'like', "%{$request->name}%");
        }

        // 서비스 상태
        if (isset($request->is_blind)) {
            $serviceList->where('service.is_blind', $request->is_blind);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $serviceList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }



        // 정렬
        $serviceList->orderBy('service.created_at', 'desc')->orderBy('id', 'desc');

        $result = $serviceList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.service.service-list', compact('result'));
    }

    /**
     * 부가 서비스 목록 보기
     */
    public function extraServiceListView(Request $request): View
    {
        $recommend = Service::with('images')
            ->select()
            ->where('type', 1)
            ->first();
        $property = Service::with('images')
            ->select()
            ->where('type', 2)
            ->first();
        $asset = Service::with('images')
            ->select()
            ->where('type', 3)
            ->first();
        $arithmometer = Service::with('images')
            ->select()
            ->where('type', 4)
            ->first();
        $app_download = Service::with('images')
            ->select()
            ->where('type', 5)
            ->first();

        return view('admin.service.service_extra-list', compact('recommend', 'property', 'asset', 'arithmometer', 'app_download'));
    }

    /**
     * 서비스 상세 화면 보기
     */
    public function serviceDetailView($id): View
    {
        $result = Service::where('id', $id)->first();
        return view('admin.service.service-detail', compact('result'));
    }

    /**
     * 서비스 등록 화면 조회
     */
    public function serviceCreateView(): View
    {
        return view('admin.service.service-create');
    }

    /**
     * 서비스 등록
     */
    public function serviceCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:50',
            'type' => 'required',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:80',
            'service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $order = Service::max('order');
        $order = $order + 1;

        // DB 추가
        $result = Service::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => $request->type,
            'order' => $order,
            'name' => $request->name,
            'title' => $request->title,
            'content' => $request->content,
            'is_blind' => $request->is_blind,
            'url' => $request->url,
        ]);

        $this->imageWithCreate($request->service_image_ids, Service::class, $result->id);

        return Redirect::route('admin.service.list.view')->with('message', '서비스를 등록했습니다.');
    }

    /**
     * 서비스 수정
     */
    public function serviceUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:50',
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:80',
            'service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = Service::where('id', $request->id)
            ->update([
                'admins_id' => Auth::guard('admin')->user()->id,
                'name' => $request->name,
                'title' => $request->title,
                'content' => $request->content,
                'is_blind' => $request->is_blind,
                'url' => $request->url,
            ]);

        $this->imageWithEdit($request->service_image_ids, Service::class, $request->id);


        return redirect()->to($request->lasturl)->with('message', '서비스를 수정했습니다.');
    }

    /**
     * 서비스 상태수정
     */
    public function serviceStateUpdate(Request $request): RedirectResponse
    {
        $result = Service::where('id', $request->id)->first()
            ->update(['is_blind' => $request->is_blind == 0 ? 1 : 0]);

        return back()->with('message', '서비스 게시상태를 수정했습니다.');
    }

    /**
     * 서비스 삭제
     */
    public function serviceDelete(Request $request): RedirectResponse
    {
        $result = Service::where('id', $request->id)->first()
            ->delete();
        return back()->with('message', '서비스를 삭제했습니다.');
    }

    /**
     * 서비스 순서 변경
     */
    public function serviceOrderUpdate(Request $request): RedirectResponse
    {
        $order_data = json_decode($request->order_data, true); // JSON 문자열을 PHP 배열로 변환

        // #1 노출순서를 바꾸는 서비스들 널값으로 변경 후에
        foreach ($order_data as $key => $value) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            Service::where('id', '=', $key)->update([
                'order' => null,
            ]);
        }

        // #2 중복된 값이 있는지 체크 후에
        foreach ($order_data as $key => $value) {
            $serviceList =  Service::where('order', $value)->get();
        }

        // #3 중복된 값이 있을 경우 롤백 작업
        if ($serviceList->count() > 1) {
            DB::rollBack();

            return back()->with('error', '서비스 순서가 중복됩니다.');
        } else {

            // #4 중복된 값이 없을 경우 순서 수정
            foreach ($order_data as $key => $value) {
                Service::where('id', $key)
                    ->update([
                        'order' => $value > 0 ? $value : null,
                    ]);
            }
        }

        return back()->with('message', '서비스 순서를 수정했습니다.');
    }

    /**
     * 추천 분양현장 서비스 등록
     */
    public function recommendServiceCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'recommend_content' => 'required|min:1|max:80',
            'recommend_service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::where('type', 1)->first();
        if ($service) {
            $service->delete();
        }

        // DB 추가
        $result = Service::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => 1,
            'name' => '추천 분양현장',
            'title' => '추천 분양현장',
            'content' => $request->recommend_content,
            'is_blind' => $request->recommend_is_blind,
            'url' => $request->recommend_url,
        ]);

        $this->imageWithEdit($request->recommend_service_image_ids, Service::class, $result->id);

        return Redirect::route('admin.extra.service.list.view')->with('message', '추천 분양현장을 저장했습니다.');
    }
    /**
     *
     * 실시간 매물지도 서비스 등록
     */
    public function propertyServiceCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'property_content' => 'required|min:1|max:80',
            'property_service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::where('type', 2)->first();
        if ($service) {
            $service->delete();
        }

        // DB 추가
        $result = Service::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => 2,
            'name' => '실시간 매물지도',
            'title' => '실시간 매물지도',
            'content' => $request->property_content,
            'is_blind' => $request->property_is_blind,
            'url' => $request->property_url,
        ]);

        $this->imageWithEdit($request->property_service_image_ids, Service::class, $result->id);

        return Redirect::route('admin.extra.service.list.view')->with('message', '실시간 매물지도를 저장했습니다.');
    }

    /**
     *
     * 내 자산관리 서비스 등록
     */
    public function assetServiceCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'asset_content' => 'required|min:1|max:80',
            'asset_service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::where('type', 3)->first();
        if ($service) {
            $service->delete();
        }

        // DB 추가
        $result = Service::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => 3,
            'name' => '내 자산관리',
            'title' => '내 자산관리',
            'content' => $request->asset_content,
            'is_blind' => $request->asset_is_blind,
            'url' => $request->asset_url,
        ]);

        $this->imageWithEdit($request->asset_service_image_ids, Service::class, $result->id);

        return Redirect::route('admin.extra.service.list.view')->with('message', '내 자산관리를 저장했습니다.');
    }
    /**
     *
     * 수익률 계산기 서비스 등록
     */
    public function arithmometerServiceCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'arithmometer_content' => 'required|min:1|max:80',
            'arithmometer_service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::where('type', 4)->first();
        if ($service) {
            $service->delete();
        }

        // DB 추가
        $result = Service::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => 4,
            'name' => '수익률 계산기',
            'title' => '수익률 계산기',
            'content' => $request->arithmometer_content,
            'is_blind' => $request->arithmometer_is_blind,
            'url' => $request->arithmometer_url,
        ]);

        $this->imageWithEdit($request->arithmometer_service_image_ids, Service::class, $result->id);

        return Redirect::route('admin.extra.service.list.view')->with('message', '수익률 계산기를 저장했습니다.');
    }

    /**
     *
     * 앱 다운로드 이미지 서비스 등록
     */
    public function appDownloadServiceCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'app_download_service_image_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::where('type', 5)->first();
        if ($service) {
            $service->delete();
        }

        // DB 추가
        $result = Service::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'type' => 5,
            'name' => '앱 다운로드',
            'title' => '앱 다운로드',
            'content' => '앱 다운로드',
            'is_blind' => $request->app_download_is_blind,
        ]);

        $this->imageWithEdit($request->app_download_service_image_ids, Service::class, $result->id);

        return Redirect::route('admin.extra.service.list.view')->with('message', '앱 다운로드를 저장했습니다.');
    }
}

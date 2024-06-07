<?php

namespace App\Http\Controllers\SiteProduct;

use App\Exports\SiteProductExport;
use App\Http\Controllers\Controller;
use App\Models\SiteProduct;
use App\Models\SiteProductAddInfo;
use App\Models\SiteProductDong;
use App\Models\SiteProductFloorInfo;
use App\Models\SiteProductOptions;
use App\Models\SiteProductPremium;
use App\Models\SiteProductPrice;
use App\Models\SiteProductSchedule;
use App\Models\SiteProductServices;
use App\Rules\AtLeastOneChecked;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class SiteProductController extends Controller
{
    /**
     * 분양현장 매물 보기
     */
    public function siteProductListView(Request $request): View
    {
        $siteProductList = SiteProduct::select()
            ->where('site_product.is_delete', '=', '0');

        // 분양 상태
        if (isset($request->is_sale)) {
            $siteProductList->where('site_product.is_sale', $request->is_sale);
        }

        // 지역
        if ($request->has('region_type')) {
            $regionTypeArray = $request->region_type;
            $siteProductList->whereIn('site_product.region_type', $regionTypeArray);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $siteProductList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $siteProductList->orderBy('site_product.created_at', 'desc')->orderBy('id', 'desc');

        $result = $siteProductList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.site_product.site_product-list', compact('result'));
    }

    /**
     * 분양현장 등록 화면 보기
     */
    public function siteProductCreateView(): View
    {
        return view('admin.site_product.site_product-create');
    }


    /**
     * 분양현장 상세 화면 보기
     */
    public function siteProductDetailView($id): View
    {
        $result = SiteProduct::with('files', 'dongInfo', 'premiumInfo')->where('id', $id)->first();

        return view('admin.site_product.site_product-detail', compact('result'));
    }


    /**
     *  분양현장 등록
     */
    public function siteProductCreate(Request $request)
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'region_type' => 'required',
            'address' => 'required',
            'region_code' => 'required',
            'region_address' => 'required',
            'address_lat' => 'required',
            'address_lng' => 'required',
            'product_name' => 'required',
            'title' => 'required',
            'min_floor' => 'required',
            'max_floor' => 'required',
            'dong_count' => 'required',
            'parking_count' => 'required',
            'generation_count' => 'required',
            'area' => 'required',
            'square' => 'required',
            'building_area' => 'required',
            'building_square' => 'required',
            'total_floor_area' => 'required',
            'total_floor_square' => 'required',
            'floor_area_ratio' => 'required',
            'builging_ratio' => 'required',
            'completion_date' => 'required',
            'expected_move_date' => 'required',
            'title_1' => 'required',
            'contents_1' => 'required',
            'title_2' => 'required',
            'contents_2' => 'required',
            'dong_info.*.dong_name' => 'required',
            'dong_info.*.floor_info.*.floor_name' => 'required',
            'dong_info.*.floor_info.*.floor_image_ids.*' => 'required',
            'siteProductMain_image_ids' => 'required',
            'schedule_title.*' => 'required',
        ], [
            'dong_info.*.dong_name.required' => '동 이름은 필수 항목입니다.',
            'dong_info.*.floor_info.*.floor_name.required' => '층 이름은 필수 항목입니다.',
            'dong_info.*.floor_info.*.floor_image_ids.*.required' => '층 도면은 필수 항목입니다.',
            'schedule_title.*' => '일정 제목은 필수 항목입니다.',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.site.product.create.view'))
                ->withErrors($validator)
                ->withInput();
        }

        $result = SiteProduct::create([
            'admins_id' => Auth::guard('admin')->user()->id,
            'region_type' => $request->region_type,
            'address' => $request->address,
            'region_code' => $request->region_code,
            'region_address' => $request->region_address,
            'address_lat' => $request->address_lat,
            'address_lng' => $request->address_lng,
            'product_name' => $request->product_name,
            'title' => $request->title,
            'contents' => $request->contents,
            'comments' => $request->comments,
            'min_floor' => $request->min_floor,
            'max_floor' => $request->max_floor,
            'dong_count' => $request->dong_count,
            'parking_count' => $request->parking_count,
            'generation_count' => $request->generation_count,
            'area' => $request->area,
            'square' => $request->square,
            'building_area' => $request->building_area,
            'building_square' => $request->building_square,
            'total_floor_area' => $request->total_floor_area,
            'total_floor_square' => $request->total_floor_square,
            'floor_area_ratio' => $request->floor_area_ratio,
            'builging_ratio' => $request->builging_ratio,
            'completion_date' => $request->completion_date,
            'expected_move_date' => $request->expected_move_date,
            'developer' => $request->developer,
            'comstruction_company' => $request->comstruction_company,
            'is_sale' => 0,
            'is_delete' => 0
        ]);


        $this->imageWithCreate($request->siteProductMain_image_ids, SiteProduct::class, $result->id);
        // $this->imageWithCreate($request->siteProductMain_image_ids, SiteProduct::class., $result->id);
        $this->fileWithCreate($request->dimension_file_ids, SiteProduct::class, $result->id);

        $premiumResult = SiteProductPremium::create([
            'site_product_id' => $result->id,
            'title_1' => $request->title_1,
            'title_2' => $request->title_2,
            'title_3' => $request->title_3,
            'title_4' => $request->title_4,
            'title_5' => $request->title_5,
            'title_6' => $request->title_6,
            'contents_1' => $request->contents_1,
            'contents_2' => $request->contents_2,
            'contents_3' => $request->contents_3,
            'contents_4' => $request->contents_4,
            'contents_5' => $request->contents_5,
            'contents_6' => $request->contents_6,
            'is_blind_1' => $request->is_blind_1 ?? 0,
            'is_blind_2' => $request->is_blind_2 ?? 0,
        ]);


        foreach ($request->dong_info as $dongIndex => $dongInfo) {
            $dongResult = SiteProductDong::create([
                'site_product_id' => $result->id,
                'dong_name' => $dongInfo['dong_name'],
            ]);
            foreach ($dongInfo['floor_info'] as $floorIndex => $floorInfo) {
                $floorResult = SiteProductFloorInfo::create([
                    'site_product_dong_id' => $dongResult->id,
                    'floor_name' => $floorInfo['floor_name'],
                    'is_neighborhood_life' => $floorInfo['is_neighborhood_life'] ?? 0,
                    'is_industry_center' => $floorInfo['is_industry_center'] ?? 0,
                    'is_warehouse' => $floorInfo['is_warehouse'] ?? 0,
                    'is_dormitory' => $floorInfo['is_dormitory'] ?? 0,
                    'is_business_support' => $floorInfo['is_business_support'] ?? 0,
                ]);

                $this->imageWithCreate($floorInfo['floor_image_ids'], SiteProductFloorInfo::class, $floorResult->id);
            }
        }

        foreach ($request->schedule_title as $index => $schedule) {
            $scheduleResult = SiteProductSchedule::create([
                'site_product_id' => $result->id,
                'title' => $schedule,
                'start_date' => $request->start_date[$index],
                'ended_date' => $request->ended_date[$index] ?? null,
                'is_ended' => $request->is_ended[$index],
            ]);
        }

        return Redirect::route('admin.site.product.list.view')->with('message', '분양현장 매물을 등록했습니다.');
    }

    /**
     *  분양현장 수정
     */
    public function siteProductUpdate(Request $request)
    {
        Log::info($request);
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'region_type' => 'required',
            'address' => 'required',
            'region_code' => 'required',
            'region_address' => 'required',
            'address_lat' => 'required',
            'address_lng' => 'required',
            'product_name' => 'required',
            'title' => 'required',
            'min_floor' => 'required',
            'max_floor' => 'required',
            'dong_count' => 'required',
            'parking_count' => 'required',
            'generation_count' => 'required',
            'area' => 'required',
            'square' => 'required',
            'building_area' => 'required',
            'building_square' => 'required',
            'total_floor_area' => 'required',
            'total_floor_square' => 'required',
            'floor_area_ratio' => 'required',
            'builging_ratio' => 'required',
            'completion_date' => 'required',
            'expected_move_date' => 'required',
            'title_1' => 'required',
            'contents_1' => 'required',
            'title_2' => 'required',
            'contents_2' => 'required',
            'dong_info.*.dong_name' => 'required',
            'dong_info.*.floor_info.*.floor_name' => 'required',
            'dong_info.*.floor_info.*.floor_image_ids.*' => 'required',
            'siteProductMain_image_ids' => 'required',
            'schedule_title.*' => 'required',
        ], [
            'dong_info.*.dong_name.required' => '동 이름은 필수 항목입니다.',
            'dong_info.*.floor_info.*.floor_name.required' => '층 이름은 필수 항목입니다.',
            'dong_info.*.floor_info.*.floor_image_ids.*.required' => '층 도면은 필수 항목입니다.',
            'schedule_title.*' => '일정 제목은 필수 항목입니다.',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.site.product.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $result = SiteProduct::where('id', $request->id)->update([
            'admins_id' => Auth::guard('admin')->user()->id,
            'region_type' => $request->region_type,
            'address' => $request->address,
            'region_code' => $request->region_code,
            'region_address' => $request->region_address,
            'address_lat' => $request->address_lat,
            'address_lng' => $request->address_lng,
            'product_name' => $request->product_name,
            'title' => $request->title,
            'contents' => $request->contents,
            'comments' => $request->comments,
            'min_floor' => $request->min_floor,
            'max_floor' => $request->max_floor,
            'dong_count' => $request->dong_count,
            'parking_count' => $request->parking_count,
            'generation_count' => $request->generation_count,
            'area' => $request->area,
            'square' => $request->square,
            'building_area' => $request->building_area,
            'building_square' => $request->building_square,
            'total_floor_area' => $request->total_floor_area,
            'total_floor_square' => $request->total_floor_square,
            'floor_area_ratio' => $request->floor_area_ratio,
            'builging_ratio' => $request->builging_ratio,
            'completion_date' => $request->completion_date,
            'expected_move_date' => $request->expected_move_date,
            'developer' => $request->developer,
            'comstruction_company' => $request->comstruction_company,
        ]);


        $this->imageWithEdit($request->siteProductMain_image_ids, SiteProduct::class, $request->id);
        $this->fileWithEdit($request->dimension_file_ids, SiteProduct::class, $request->id);

        // 분양매물 프리미엄은 하나의 테이블로 구성되어 있어 삭제하지 않고 업데이트
        $premiumResult = SiteProductPremium::where('site_product_id', $request->id)->update([
            'site_product_id' => $request->id,
            'title_1' => $request->title_1,
            'title_2' => $request->title_2,
            'title_3' => $request->title_3,
            'title_4' => $request->title_4,
            'title_5' => $request->title_5,
            'title_6' => $request->title_6,
            'contents_1' => $request->contents_1,
            'contents_2' => $request->contents_2,
            'contents_3' => $request->contents_3,
            'contents_4' => $request->contents_4,
            'contents_5' => $request->contents_5,
            'contents_6' => $request->contents_6,
            'is_blind_1' => $request->is_blind_1 ?? 0,
            'is_blind_2' => $request->is_blind_2 ?? 0,
        ]);

        // 분양매물 ID에 해당되는 동 아이디로 층 삭제 후에 동까지 삭제 후에 다시 생성
        $dongResult = SiteProductDong::where('site_product_id', $request->id)->pluck('id')->toArray();
        SiteProductFloorInfo::whereIn('site_product_dong_id', $dongResult)->delete();
        SiteProductDong::where('site_product_id', $request->id)->delete();


        foreach ($request->dong_info as $dongIndex => $dongInfo) {
            $dongResult = SiteProductDong::create([
                'site_product_id' => $request->id,
                'dong_name' => $dongInfo['dong_name'],
            ]);
            foreach ($dongInfo['floor_info'] as $floorIndex => $floorInfo) {
                $floorResult = SiteProductFloorInfo::create([
                    'site_product_dong_id' => $dongResult->id,
                    'floor_name' => $floorInfo['floor_name'],
                    'is_neighborhood_life' => $floorInfo['is_neighborhood_life'] ?? 0,
                    'is_industry_center' => $floorInfo['is_industry_center'] ?? 0,
                    'is_warehouse' => $floorInfo['is_warehouse'] ?? 0,
                    'is_dormitory' => $floorInfo['is_dormitory'] ?? 0,
                    'is_business_support' => $floorInfo['is_business_support'] ?? 0,
                ]);

                $this->imageWithEdit($floorInfo['floor_image_ids'], SiteProductFloorInfo::class, $floorResult->id);
            }
        }

        // 분양매물에 해당되는 분양일정 삭제후 다시 생성
        SiteProductSchedule::where('site_product_id', $request->id)->delete();

        foreach ($request->schedule_title as $index => $schedule) {
            $scheduleResult = SiteProductSchedule::create([
                'site_product_id' => $request->id,
                'title' => $schedule,
                'start_date' => $request->start_date[$index],
                'ended_date' => $request->ended_date[$index] ?? null,
                'is_ended' => $request->is_ended[$index],
            ]);
        }

        return Redirect::route('admin.site.product.detail.view', [$request->id])->with('message', '분양현장 매물을 수정했습니다.');
    }


    /**
     * 분양현장 매물 정보 다운로드
     */
    public function exportSiteProduct(Request $request)
    {
        return Excel::download(new SiteProductExport($request), '분양현장 매물_' . Carbon::now() . '.xlsx');
    }
}

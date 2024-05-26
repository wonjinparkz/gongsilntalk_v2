<?php

namespace App\Http\Controllers\SiteProduct;

use App\Http\Controllers\Controller;
use App\Models\SiteProduct;
use App\Models\SiteProductAddInfo;
use App\Models\SiteProductDong;
use App\Models\SiteProductFloorInfo;
use App\Models\SiteProductOptions;
use App\Models\SiteProductPrice;
use App\Models\SiteProductServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiteProductController extends Controller
{
    /**
     * 분양현장 매물 보기
     */
    public function siteProductListView(Request $request): View
    {
        $siteProductList = SiteProduct::select();

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
     *  분양현장 등록
     */
    public function siteProductCreate(Request $request)
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
            'title_1' => 'required',
            'contents_2' => 'required',
            'contents_3' => 'required',
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
        $this->fileWithCreate($request->dimension_file_ids, SiteProduct::class, $result->id);


        foreach ($request->dong_info as $dongIndex => $dongInfo) {
            $dongResult = SiteProductDong::create([
                'site_product_id' => $result->id,
                'dong_name' => $dongInfo['dong_name'],
            ]);
            foreach ($dongInfo as $floorIndex => $floorInfo) {
                $floorResult = SiteProductFloorInfo::create([
                    'site_product_dong_id' => $dongResult->id,
                    'floor_name' => $floorInfo['floor_name'],
                    'is_neighborhood_life' =>$floorInfo['is_neighborhood_life'] ?? 0,
                    'is_industry_center' =>$floorInfo['is_industry_center'] ?? 0,
                    'is_warehouse' =>$floorInfo['is_warehouse'] ?? 0,
                    'is_dormitory' =>$floorInfo['is_dormitory'] ?? 0,
                    'is_business_support' =>$floorInfo['is_business_support'] ?? 0,
                ]);

                $this->imageWithCreate($floorInfo['floor_image_idxs'], SiteProductFloorInfo::class, $floorResult->id);
            }
        }
    }
}

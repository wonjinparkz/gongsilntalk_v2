<?php

namespace App\Http\Controllers\SiteProduct;

use App\Http\Controllers\Controller;
use App\Models\RecentProduct;
use App\Models\SiteProduct;
use App\Models\SiteProductFloorInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiteProductPcController extends Controller
{
    /**
     * 분양현장 리스트
     */
    public function siteProductListView(Request $request): View
    {

        $siteProductList = SiteProduct::select('site_product.*', 'site_product.id as id')->where('is_delete', 0);

        if (Auth::guard('web')->user() != null) {
            $siteProductList->like('site_product', Auth::guard('web')->user()->id ?? "");
        }

        if ($request->is_sale != '') {
            $siteProductList->where('site_product.is_sale', '=', $request->is_sale ?? '');
        }

        if (isset($request->region) && count($request->region) > 0) {
            $siteProductList->whereIn('site_product.region_type',  $request->region);
        }


        if (isset($request->m_region) &&  count($request->m_region) > 0) {
            $siteProductList->whereIn('site_product.region_type', $request->m_region);
        }

        // 정렬
        $siteProductList->orderBy('site_product.created_at', 'desc')->orderBy('site_product.id', 'desc');

        $result = $siteProductList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('www.siteProduct.siteProduct_list', compact('result'));
    }


    /**
     * 분양현장 상세 화면 보기
     */
    public function siteProductDetailView($id): View
    {
        $result = SiteProduct::with('images', 'edu_images', 'files', 'dongInfo', 'premiumInfo')->select('site_product.*');

        if (Auth::guard('web')->user() != null) {
            $result->like('site_product', Auth::guard('web')->user()->id ?? "");
        }

        $result = $result->where('site_product.id', $id)->first();

        // 최근 본 매물 등록
        if (Auth::guard('web')->check()) {
            $check = RecentProduct::where('users_id', Auth::guard('web')->user()->id)
                ->where('product_id', $id)
                ->where('product_type', 'site_product')->first();

            if ($check == null) {
                $recent_product = RecentProduct::create([
                    'users_id' => Auth::guard('web')->user()->id,
                    'product_id' => $id,
                    'product_type' => 'site_product',
                ]);
            }
        }

        return view('www.siteProduct.siteProduct_detail', compact('result'));
    }


    /**
     * 각 동별 층 정보 불러오기
     */
    public function floorList(Request $request)
    {
        $result = SiteProductFloorInfo::select()->where('site_product_dong_id', $request->dong_id)->get();

        return $this->sendResponse($result, '층 정보 입니다.');
    }

    /**
     * 각 층 상세 정보 불러오기
     */
    public function floorDetail(Request $request)
    {
        $result = SiteProductFloorInfo::with('images')->select()->where('id', $request->floor_id)->first();

        return $this->sendResponse($result, '층 상세 정보 입니다.');
    }
}

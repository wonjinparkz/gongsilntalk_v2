<?php

namespace App\Http\Controllers\SiteProduct;

use App\Http\Controllers\Controller;
use App\Models\SiteProduct;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteProductPcController extends Controller
{
    /**
     * 분양현장 리스트
     */
    public function siteProductListView(Request $request): View
    {

        $siteProductList = SiteProduct::select()->where('is_delete', 0);

        // 정렬
        $siteProductList->orderBy('site_product.created_at', 'desc')->orderBy('id', 'desc');

        $result = $siteProductList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('www.siteProduct.siteProduct_list', compact('result'));
    }


    /**
     * 분양현장 상세 화면 보기
     */
    public function siteProductDetailView($id): View
    {
        $result = SiteProduct::with('files', 'dongInfo', 'premiumInfo')->where('id', $id)->first();

        return view('www.siteProduct.siteProduct_detail', compact('result'));
    }
}

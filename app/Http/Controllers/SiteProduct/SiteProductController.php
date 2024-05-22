<?php

namespace App\Http\Controllers\SiteProduct;

use App\Http\Controllers\Controller;
use App\Models\SiteProduct;
use App\Models\SiteProductAddInfo;
use App\Models\SiteProductOptions;
use App\Models\SiteProductPrice;
use App\Models\SiteProductServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * 지식산업센터 등록 화면 조회
     */
    public function siteProductCreateView(): View
    {
        return view('admin.site_product.site_product-create');
    }
}

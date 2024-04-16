<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductPcController extends Controller
{
    /**
     * 내 매물 관리
     */
    public function productCreateView(): View
    {
        return view('www.product.product_create');
    }
}

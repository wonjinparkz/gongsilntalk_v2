<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProductPcController extends Controller
{
    /**
     * 내 매물 등록 관리
     */
    public function productCreateView(): View
    {
        return view('www.product.product_create');
    }

    /**
     * 매물 등록 매물유형 및 가격 체크
     */
    public function productCreateTypeCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails()) {
            return redirect(route('www.product.create.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.product.create2.view', compact('request'));
    }
}

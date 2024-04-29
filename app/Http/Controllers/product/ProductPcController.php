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
     * 내 매물 등록 관리
     */
    public function productCreate2View(): View
    {
        return view('www.product.product_create2');
    }
    /**
     * 내 매물 등록 관리
     */
    public function productCreate3View(): View
    {
        return view('www.product.product_create3');
    }

    /**
     * 매물 등록 매물유형 및 가격 체크
     */
    public function productCreateTypeCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => "required",
            'payment_type' => "required",
            'price' => "required",
            'month_price' => 'required_if:payment_type,1,2,4',
            'is_price_discussion' => 'required',
            'is_use' => 'required',
            'current_price' => 'required_if:is_use,1',
            'current_month_price' => 'required_if:is_use,1',
            'is_premium' => 'required_if:type,3',
            'premium_price' => 'required_if:is_premium,1',
            'approve_date' => 'required_if:type,>=,14',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.product.create.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.product.create2.view', compact('request'));
    }
    /**
     * 매물 등록 매물유형 및 가격 체크
     */
    public function productCreateAddressCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect(route('www.product.create2.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.product.create3.view', compact('request'));
    }

    /**
     * 매물 등록
     */
    public function productCreate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => "required",
            'payment_type' => "required",
            'price' => "required",
            'month_price' => 'required_if:payment_type,1,2,4',
            'is_price_discussion' => 'required',
            'is_use' => 'required',
            'current_price' => 'required_if:is_use,1',
            'current_month_price' => 'required_if:is_use,1',
            'is_premium' => 'required_if:type,3',
            'premium_price' => 'required_if:is_premium,1',
            'approve_date' => 'required_if:type,>=,14',
            'address_lng' => 'required',
            'address_lat' => 'required',
            'region_code' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.product.create3.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.mypage.product.magagement.list.view')->with('message', '매물을 등록했습니다.');
    }
}

<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect(route('www.product.create3.view'))->withErrors($validator)
                ->withInput();
        }

        // DB 추가
        $result = Product::create([
            'users_id' => Auth::guard('web')->user()->id,
            'user_type' => $request->user_type,
            'state' => $request->state,
            'type' => $request->type,
            'is_map' => $request->is_map,
            'address_lat' => $request->address_lat,
            'address_lng' => $request->address_lng,
            'region_code' => $request->region_code,
            'region_address' => $request->region_address,
            'address' => $request->address,
            'address_detail' => $request->address_detail,
            'address_dong' => $request->address_dong,
            'address_number' => $request->address_number,
            'floor_number' => $request->floor_number,
            'total_floor_number' => $request->total_floor_number,
            'area' => $request->area,
            'square' => $request->square,
            'exclusive_area' => $request->exclusive_area,
            'exclusive_square' => $request->exclusive_square,
            'total_floor_area' => $request->total_floor_area,
            'total_floor_square' => $request->total_floor_square,
            'approve_date' => $request->approve_date,
            'building_type' => $request->building_type,
            'move_type' => $request->move_type,
            'move_date' => $request->move_date,
            'is_service' => $request->is_service,
            'service_price' => $request->service_price,
            'loan_type' => $request->loan_type,
            'loan_price' => $request->loan_price,
            'parking_type' => $request->parking_type,
            'parking_price' => $request->parking_price,
            'comments' => $request->comments,
            'contents' => $request->contents,
            'image_link' => $request->image_link,
            'update_user_type' => $request->update_user_type,
            'commission' => $request->commission,
            'commission_rate' => $request->commission_rate,
            'is_blind' => 0,
            'is_delete' => 0,
        ]);

        $subResult = ProductPrice::create([
            'product_id' => $result->id,
            'payment_type' => $request->payment_type,
            'price' => $request->price,
            'month_price' => $request->month_price,
            'is_price_discussion' => $request->is_price_discussion,
            'is_use' => $request->is_use,
            'current_price' => $request->current_price,
            'current_month_price' => $request->current_month_price,
            'is_premium' => $request->is_premium,
            'premium_price' => $request->premium_price,
        ]);

        $this->imageWithCreate($request->product_image_ids, Product::class, $result->id);

        return Redirect::route('www.mypage.product.magagement.list.view')->with('message', '매물을 등록했습니다.');
    }
}

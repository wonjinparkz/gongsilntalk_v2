<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    // 중개사 매물

    /**
     * 중개사 매물 등록 챕터1
     */
    public function corpProductCreateView(Request $request): View
    {
        return view('www.product.corp_product_create');
    }
    /**
     * 중개사 매물 등록 챕터2
     */
    public function corpProductCreate2View(Request $request): View
    {
        Log::info($request->all());

        $result = $request->all();

        return view('www.product.corp_product_create2', compact('result'));
    }
    /**
     * 중개사 매물 등록 챕터3
     */
    public function corpProductCreate3View(Request $request): View
    {
        Log::info($request->all());

        $result = $request->all();

        return view('www.product.corp_product_create3', compact('result'));
    }
    /**
     * 중개사 매물 등록 챕터4
     */
    public function corpProductCreate4View(Request $request): View
    {
        Log::info($request->all());

        $result = $request->all();

        return view('www.product.corp_product_create4', compact('result'));
    }
    /**
     * 중개사 매물 등록 챕터5
     */
    public function corpProductCreate5View(Request $request): View
    {
        Log::info($request->all());

        $result = $request->all();

        return view('www.product.corp_product_create5', compact('result'));
    }

    /**
     * 매물 등록 매물유형 및 가격 체크
     */
    public function corpProductCreateTypeCheck(Request $request): RedirectResponse
    {
        Log::info($request);
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
            return redirect(route('www.corp.product.create.view'))->withErrors($validator)
                ->withInput();
        }

        $result['type'] = $request->type;
        $result['payment_type'] = $request->payment_type;
        $result['price'] = $request->price;
        $result['month_price'] = $request->month_price;
        $result['is_price_discussion'] = $request->is_price_discussion;
        $result['is_use'] = $request->is_use;
        $result['current_price'] = $request->current_price;
        $result['current_month_price'] = $request->current_month_price;
        $result['is_premium'] = $request->is_premium;
        $result['premium_price'] = $request->premium_price;
        $result['approve_date'] = $request->approve_date;

        return Redirect::route('www.corp.product.create2.view', $result);
    }

    /**
     * 매물 등록 매물 주소 체크
     */
    public function corpProductCreateAddressCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'region_code' => 'required',
            'region_address' => 'required',
            'address_lat' => 'required_if:is_map,1',
            'address_lng' => 'required_if:is_map,1',
            'address_detail' =>  [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('is_map') == 0 && $request->input('is_address_detail') != 1;
                }),
            ],
            'address_dong' =>  [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('is_map') == 1 && $request->input('is_address_dong') != 1;
                }),
            ],
        ]);

        if ($validator->fails()) {
            return redirect(route('www.corp.product.create2.view'))->withErrors($validator)
                ->withInput();
        }


        $result['type'] = $request->type;
        $result['payment_type'] = $request->payment_type;
        $result['price'] = $request->price;
        $result['month_price'] = $request->month_price;
        $result['is_price_discussion'] = $request->is_price_discussion;
        $result['is_use'] = $request->is_use;
        $result['current_price'] = $request->current_price;
        $result['current_month_price'] = $request->current_month_price;
        $result['is_premium'] = $request->is_premium;
        $result['premium_price'] = $request->premium_price;
        $result['approve_date'] = $request->approve_date;
        $result['address_lng'] = $request->address_lng;
        $result['address_lat'] = $request->address_lat;
        $result['region_code'] = $request->region_code;
        $result['region_address'] = $request->region_address;
        $result['address'] = $request->address;
        $result['address_detail'] = $request->address_detail;
        $result['address_dong'] = $request->address_dong;
        $result['address_number'] = $request->address_number;

        return Redirect::route('www.corp.product.create3.view', $result);
    }

    /**
     * 매물 등록 매물 주소 체크
     */
    public function corpProductCreateInfoCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'floor_number' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('type') != 6 && $request->input('type') != 7;
                }),
            ],
            'total_floor_number' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('type') != 6 && $request->input('type') != 7;
                }),
            ],
            'lowest_floor_number' => 'required_if:type,7',
            'top_floor_number' => 'required_if:type,7',
            'area' => 'required',
            'square' => 'required',
            'total_floor_area' => 'required_if:type,7',
            'total_floor_square' => 'required_if:type,7',
            'exclusive_area' => 'required_unless:type,6',
            'exclusive_square' => 'required_unless:type,6',
            'approve_date' => 'required_unless:type,6',
            'building_type' => 'required',
            'move_type' => 'required_unless:type,6',
            'move_date' => 'required_if:move_type,2',
            'service_price' => 'required_unless:is_service,1',
            'service_type' => 'required_unless:is_service,1',
            'loan_type' => 'required',
            'loan_price' => 'required_unless:loan_type,0',
            'parking_type' => 'required_unless:type,6',
            'parking_price' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('type') != 6 && $request->input('parking_type') == 1 && $request->input('is_parking') != 1;
                }),
            ],
        ]);

        if ($validator->fails()) {
            return redirect(route('www.corp.product.create3.view'))->withErrors($validator)
                ->withInput();
        }


        $result['type'] = $request->type;
        $result['payment_type'] = $request->payment_type;
        $result['price'] = $request->price;
        $result['month_price'] = $request->month_price;
        $result['is_price_discussion'] = $request->is_price_discussion;
        $result['is_use'] = $request->is_use;
        $result['current_price'] = $request->current_price;
        $result['current_month_price'] = $request->current_month_price;
        $result['is_premium'] = $request->is_premium;
        $result['premium_price'] = $request->premium_price;
        $result['approve_date'] = $request->approve_date;
        $result['address_lng'] = $request->address_lng;
        $result['address_lat'] = $request->address_lat;
        $result['region_code'] = $request->region_code;
        $result['region_address'] = $request->region_address;
        $result['address'] = $request->address;
        $result['address_detail'] = $request->address_detail;
        $result['address_dong'] = $request->address_dong;
        $result['address_number'] = $request->address_number;

        $result['floor_number'] = $request->floor_number;
        $result['total_floor_number'] = $request->total_floor_number;
        $result['lowest_floor_number'] = $request->lowest_floor_number;
        $result['top_floor_number'] = $request->top_floor_number;
        $result['area'] = $request->area;
        $result['square'] = $request->square;
        $result['total_floor_area'] = $request->total_floor_area;
        $result['total_floor_square'] = $request->total_floor_square;
        $result['exclusive_area'] = $request->exclusive_area;
        $result['exclusive_square'] = $request->exclusive_square;
        $result['approve_date'] = $request->approve_date;
        $result['building_type'] = $request->building_type;
        $result['move_type'] = $request->move_type;
        $result['move_date'] = $request->move_date;
        $result['is_service'] = $request->is_service;
        $result['service_price'] = $request->service_price;
        $result['service_type'] = $request->service_type;
        $result['loan_type'] = $request->loan_type;
        $result['loan_price'] = $request->loan_price;
        $result['parking_type'] = $request->parking_type;
        $result['parking_price'] = $request->parking_price;


        return Redirect::route('www.corp.product.create4.view', $result);
    }
}

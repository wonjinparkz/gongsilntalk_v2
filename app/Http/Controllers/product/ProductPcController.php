<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAddInfo;
use App\Models\ProductOptions;
use App\Models\ProductPrice;
use App\Models\ProductServices;
use App\Models\User;
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
        // 매물 등록번호 생성
        $productCode = $this->generateProductCode();


        // DB 추가
        $result = Product::create([
            'users_id' => Auth::guard('web')->user()->id,
            'product_number' => $productCode,
            'user_type' => $request->user_type,
            'state' => 0,
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
            'contents' => $request->content,
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
            'is_use' => $request->is_use ?? 0,
            'current_price' => $request->current_price,
            'current_month_price' => $request->current_month_price,
            'is_premium' => $request->is_premium,
            'premium_price' => $request->premium_price,
        ]);

        $this->imageWithCreate($request->product_image_ids, Product::class, $result->id);


        $user = User::select()->where('id', Auth::guard('web')->user()->id)->first();

        $this->kakaoSend('127', $user->name, $user->phone);

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
        $result['is_map'] = $request->is_map;
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
            'type' => 'required',
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
        $result['is_map'] = $request->is_map;
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

    /**
     * 매물 등록 매물 주소 체크
     */
    public function corpProductCreateAddInfoCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'room_count' => 'required_if:type,8,10,11,12,13',
            'bathroom_count' => 'required_if:type,8,10,11,12,13',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.corp.product.create4.view'))->withErrors($validator)
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
        $result['is_map'] = $request->is_map;
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

        $result['room_count'] = $request->room_count;
        $result['bathroom_count'] = $request->bathroom_count;
        $result['current_business_type'] = $request->current_business_type;
        $result['recommend_business_type'] = $request->recommend_business_type;
        $result['direction_type'] = $request->direction_type;
        $result['cooling_type'] = $request->cooling_type;
        $result['heating_type'] = $request->heating_type;
        $result['weight'] = $request->weight;
        $result['is_elevator'] = $request->is_elevator;
        $result['is_goods_elevator'] = $request->is_goods_elevator;
        $result['structure_type'] = $request->structure_type;
        $result['builtin_type'] = $request->builtin_type;
        $result['interior_type'] = $request->interior_type;
        $result['declare_type'] = $request->declare_type;
        $result['is_dock'] = $request->is_dock;
        $result['is_hoist'] = $request->is_hoist;
        $result['floor_height_type'] = $request->floor_height_type;
        $result['wattage_type'] = $request->wattage_type;
        $result['land_use_type'] = $request->land_use_type;
        $result['city_plan_type'] = $request->city_plan_type;
        $result['building_permit_type'] = $request->building_permit_type;
        $result['land_permit_type'] = $request->land_permit_type;
        $result['access_load_type'] = $request->access_load_type;
        $result['is_option'] = $request->is_option;
        $result['option_type'] = $request->option_type;


        return Redirect::route('www.corp.product.create5.view', $result);
    }

    /**
     * 중개사 매물 등록
     */
    public function corpProductCreate(Request $request): RedirectResponse
    {


        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'address' => 'required',
            'region_code' => 'required',
            'region_address' => 'required',
            'address_lat' => 'required_if:is_map,1',
            'address_lng' => 'required_if:is_map,1',
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
            'payment_type' => 'required',
            'price' => 'required',
            'month_price' => 'required_if:payment_type,1,2,4',
            'current_price' => [
                Rule::requiredIf(function () use ($request) {
                    return !in_array($request->input('type'), [14, 15, 16, 17]) && $request->input('is_use') == 1;
                }),
            ],
            'premium_price' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('type') == 3 && $request->input('is_premium') == 1;
                }),
            ],
            'room_count' => 'required_if:type,8,10,11,12,13',
            'bathroom_count' => 'required_if:type,8,10,11,12,13',
            'product_image_ids' => 'required',
            'comments' => 'required',
            'commission' => 'required',
            'commission_rate' => 'required',

        ]);

        Log::info($request);

        if ($validator->fails()) {
            return redirect(route('www.corp.product.create5.view', $request->input()))
                ->withErrors($validator)
                ->withInput();
        }

        // 매물 등록번호 생성
        $productCode = $this->generateProductCode();

        $productDate = [
            'product_number' => $productCode,
            'users_id' => Auth::guard('web')->user()->id,
            'user_type' => 1,
            'type' => $request->type,
            'is_map' => $request->is_map,
            'state' => 1,
            'is_map' => $request->is_map ?? 0,
            'region_code' => $request->region_code,
            'region_address' => $request->region_address,
            'address' => $request->address,
            'address_lat' => $request->is_map != 1 ? $request->address_lat : null,
            'address_lng' => $request->is_map != 1 ? $request->address_lng : null,
            'address_detail' => $request->is_map != 1 ? $request->address_detail : null,
            'address_dong' => $request->is_map == 1 ? $request->address_dong : null,
            'address_number' => $request->is_map == 1 ? $request->address_number : null,
            'floor_number' => in_array($request->type, ['6', '7']) ? null : $request->floor_number,
            'total_floor_number' => in_array($request->type, ['6', '7']) ? null : $request->total_floor_number,
            'lowest_floor_number' => $request->type == 7 ? $request->lowest_floor_number : null,
            'top_floor_number' => $request->type == 7 ? $request->top_floor_number : null,
            'area' => $request->area,
            'square' => $request->square,
            'exclusive_area' => $request->type != 6 ? $request->exclusive_area : null,
            'exclusive_square' => $request->type != 6 ? $request->exclusive_square : null,
            'total_floor_area' => $request->type == 7 ? $request->total_floor_area : null,
            'total_floor_square' => $request->type == 7 ? $request->total_floor_square : null,
            'approve_date' => $request->type != 6 ? $request->approve_date : null,
            'building_type' => $request->building_type,
            'move_type' => $request->type != 6 ? $request->move_type : null,
            'move_date' => ($request->type != 6 && $request->move_type == 2) ? $request->move_date : null,
            'is_service' => $request->type != 6 ? $request->is_service ?? 0 : null,
            'service_price' => ($request->type != 6 && $request->is_service != 1) ? $request->service_price : null,
            'loan_type' => $request->loan_type,
            'loan_price' => $request->loan_type != 0 ? $request->loan_price : null,
            'parking_type' => $request->type != 6 ? $request->parking_type : null,
            'parking_price' => $request->type != 6 && ($request->parking_type == 1 && $request->is_parking != 1) ? $request->parking_price : null,
            'comments' => $request->comments,
            'contents' => $request->contents,
            'image_link' => $request->image_link,
            'commission' => $request->commission,
            'commission_rate' => $request->commission_rate,
            'is_blind' => 0,
            'is_delete' => 0,
        ];


        $result = Product::create($productDate);

        ProductServices::where('product_id', $result->id)->delete();
        ProductPrice::where('product_id', $result->id)->delete();
        ProductAddInfo::where('product_id', $result->id)->delete();
        ProductOptions::where('product_id', $result->id)->delete();

        // 관리비 항목
        if (isset($request->service_type)) {

            $serviceTypes = array_map('intval', $request->service_type);

            foreach ($serviceTypes as $service_type) {
                ProductServices::create([
                    'product_id' => $result->id,
                    'type' => $service_type,
                ]);
            }
        }


        // 가격정보
        $premium_price = $request->premium_price;

        if ($request->type == 3) {
            $premium_price = $request->is_premium == 1 ? $premium_price : '';
        } else if ($request->type > 13) {
            $premium_price = $premium_price;
        }
        ProductPrice::create([
            'product_id' => $result->id,
            'payment_type' => $request->payment_type,
            'price' => $request->price,
            'month_price' => in_array($request->payment_type, [1, 2, 4]) ? $request->month_price : null,
            'is_price_discussion' => $request->is_price_discussion ?? 0,
            'is_use' => $request->type >= 14 ? NULL : $request->is_use ?? 0,
            'current_price' =>  $request->type < 14 && $request->is_use == 1 ? $request->current_price : null,
            'current_month_price' =>  $request->type < 14 && $request->is_use == 1 ? $request->current_month_price : null,
            'is_premium' => $request->type == 3 ? $request->is_premium : null,
            'premium_price' => $premium_price,
        ]);



        // 추가정보
        if (in_array($request->type, [0, 1, 2, 4])) {
            $product_add_info = [
                'product_id' => $result->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'weight' => $request->weight,
                'is_elevator' => $request->is_elevator,
                'is_goods_elevator' => $request->is_goods_elevator,
                'floor_height_type' => $request->floor_height_type,
                'wattage_type' => $request->wattage_type,
                'is_option' => $request->is_option,

            ];
        } else if ($request->type == 3) {
            $product_add_info = [
                'product_id' => $result->id,
                'current_business' => $request->current_business,
                'recommend_business_type' => $request->recommend_business_type,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 5) {
            $product_add_info = [
                'product_id' => $result->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 6) {
            $product_add_info = [
                'product_id' => $result->id,
                'land_use_type' => $request->land_use_type,
                'city_plan_type' => $request->city_plan_type,
                'building_permit_type' => $request->building_permit_type,
                'land_permit_type' => $request->land_permit_type,
                'access_load_type' => $request->access_load_type,
            ];
        } else if ($request->type == 7) {
            $product_add_info = [
                'product_id' => $result->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'recommend_business_type' => $request->recommend_business_type,
                'is_elevator' => $request->is_elevator,
                'is_goods_elevator' => $request->is_goods_elevator,
                'is_dock' => $request->is_dock,
                'is_hoist' => $request->is_hoist,
                'floor_height_type' => $request->floor_height_type,
                'wattage_type' => $request->wattage_type,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 9) {
            $product_add_info = [
                'product_id' => $result->id,
                'room_count' => $request->room_count,
                'bathroom_count' => $request->bathroom_count,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'structure_type' => $request->structure_type,
                'builtin_type' => $request->builtin_type,
                'is_elevator' => $request->is_elevator,
                'declare_type' => $request->declare_type,
                'is_option' => $request->is_option,
            ];
        } else if (in_array($request->type, [8, 10, 11, 12, 13])) {
            $product_add_info = [
                'product_id' => $result->id,
                'room_count' => $request->room_count,
                'bathroom_count' => $request->bathroom_count,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type > 13) {
            $product_add_info = [
                'product_id' => $result->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'weight' => $request->weight,
                'is_elevator' => $request->is_elevator,
                'is_goods_elevator' => $request->is_goods_elevator,
                'interior_type' => $request->interior_type,
                'floor_height_type' => $request->floor_height_type,
                'wattage_type' => $request->wattage_type,
                'is_option' => $request->is_option,
            ];
        }

        ProductAddInfo::create($product_add_info);

        // 옵션정보
        if ($request->type != 6 && $request->is_option == 1 && isset($request->option_type)) {

            $optionTypes = array_map('intval', $request->option_type);

            foreach ($optionTypes as $option_type) {
                ProductOptions::create([
                    'product_id' => $result->id,
                    'type' => $option_type,
                ]);
            }
        }

        $this->imageWithCreate($request->product_image_ids, Product::class, $result->id);

        $user = User::select()->where('id', Auth::guard('web')->user()->id)->first();

        $this->kakaoSend('127', $user->name, $user->phone);

        return Redirect::route('www.mypage.corp.product.magagement.list.view')->with('message', '매물을 등록했습니다.');
    }

    // 매물 등록번호 생성 메서드
    protected function generateProductCode()
    {
        $datePart = date('ymd'); // YYMMDD 형식
        $todayCount = Product::whereDate('created_at', today())->count() + 1;
        $numberPart = str_pad($todayCount, 4, '0', STR_PAD_LEFT);

        return $datePart . $numberPart;
    }
}

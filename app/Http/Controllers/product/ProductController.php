<?php

namespace App\Http\Controllers\product;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAddInfo;
use App\Models\ProductOptions;
use App\Models\ProductPrice;
use App\Models\ProductServices;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * 일반회원 매물 보기
     */
    public function productListView(Request $request): View
    {
        $productList = Product::select()
            ->where('is_delete', '0');

        $productList->with('users');
        $productList->with('priceInfo');

        $productList->whereHas('users', function ($query) use ($request) {
            // 사용자 이름
            if (isset($request->name)) {
                $query->where('users.name', 'like', "%{$request->name}%");
            }
        });

        $productList->whereHas('priceInfo', function ($query) use ($request) {
            // 거래유형
            if ($request->has('payment_type')) {
                $query->whereIn('product_price.payment_type', $request->payment_type);
            }
        });

        // 매물 상태
        if (isset($request->state)) {
            $productList->where('product.state', $request->state);
        }

        // 매물종류
        if ($request->has('type')) {
            $productList->whereIn('product.type', $request->type);
        }

        // 게시 시작일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $productList->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        }

        // 정렬
        $productList->orderBy('product.created_at', 'desc')->orderBy('id', 'desc');

        $result = $productList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.product.product-list', compact('result'));
    }

    /**
     * 일반회원 매물 상세 화면 보기
     */
    public function productDetailView($id): View
    {
        $result = Product::with('images', 'users', 'priceInfo', 'productAddInfo', 'productOptions', 'productServices')->where('id', $id)->first();

        return view('admin.product.product-detail', compact('result'));
    }


    /**
     * 일반회원 매물 상태 수정
     */
    public function productStateUpdate(Request $request): RedirectResponse
    {
        $result = Product::where('id', $request->id)->first()
            ->update(['state' => $request->state]);

        return back()->with('message', '매물 상태를 수정했습니다.');
    }


    /**
     * 일반회원 매물 수정
     */
    public function productUpdate(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'type' => 'required',
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
            'address_number' => 'required_if:is_map,1',
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
            return redirect(route('admin.product.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $productDate = [
            'type' => $request->type,
            'is_map' => $request->is_map,
            'state' => $request->state,
            'is_map' => $request->is_map ?? 0,
            'region_code' => $request->region_code,
            'region_address' => $request->region_address,
            'address' => $request->address,
            'address_lat' => $request->is_map != 1 ? $request->address_lat : null,
            'address_lng' => $request->is_map != 1 ? $request->address_lng : null,
            'address_detail' => $request->is_map != 1 ? $request->address_detail : null,
            'address_dong' => $request->is_map == 1 ? $request->address_dong : null,
            'address_number' => $request->is_map == 1 ? $request->address_number : null,
            'floor_number' => in_array($request->type, ['6', '7']) ? '' : $request->floor_number,
            'total_floor_number' => in_array($request->type, ['6', '7']) ? '' : $request->total_floor_number,
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
            'update_user_type' => 1
        ];


        $result = Product::where('id', $request->id)
            ->update($productDate);

        ProductServices::where('product_id', $request->id)->delete();
        ProductPrice::where('product_id', $request->id)->delete();
        ProductAddInfo::where('product_id', $request->id)->delete();
        ProductOptions::where('product_id', $request->id)->delete();

        // 관리비 항목
        if ($request->has('service_type')) {
            foreach ($request->service_type as $service_type) {
                ProductServices::create([
                    'product_id' => $request->id,
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
            'product_id' => $request->id,
            'payment_type' => $request->payment_type,
            'price' => $request->price,
            'month_price' => in_array($request->payment_type, [1, 2, 4]) ? $request->month_price : null,
            'is_price_discussion' => $request->is_price_discussion ?? 0,
            'is_use' => $request->type > 13 ? '' : $request->is_use,
            'current_price' =>  $request->type < 14 && $request->is_use == 1 ? $request->current_price : null,
            'current_month_price' =>  $request->type < 14 && $request->is_use == 1 ? $request->current_month_price : null,
            'is_premium' => $request->type == 3 ? $request->is_premium : null,
            'premium_price' => $premium_price,
        ]);



        // 추가정보
        if (in_array($request->type, [0, 1, 2, 4])) {
            $product_add_info = [
                'product_id' => $request->id,
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
                'product_id' => $request->id,
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
                'product_id' => $request->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 6) {
            $product_add_info = [
                'product_id' => $request->id,
                'land_use_type' => $request->land_use_type,
                'city_plan_type' => $request->city_plan_type,
                'building_permit_type' => $request->building_permit_type,
                'land_permit_type' => $request->land_permit_type,
                'access_load_type' => $request->access_load_type,
            ];
        } else if ($request->type == 7) {
            $product_add_info = [
                'product_id' => $request->id,
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
            Log::info('오피스텔');
            $product_add_info = [
                'product_id' => $request->id,
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
                'product_id' => $request->id,
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
                'product_id' => $request->id,
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
        if ($request->type != 6 && $request->is_option == 1 && $request->has('option_type')) {
            foreach ($request->option_type as $option_type) {
                ProductOptions::create([
                    'product_id' => $request->id,
                    'type' => $option_type,
                ]);
            }
        }

        $this->imageWithEdit($request->product_image_ids, Product::class, $request->id);

        return redirect()->to($request->last_url)->with('message', '매물을 수정했습니다.');
    }

    /**
     * 일반회원 매물 정보 다운로드
     */
    public function exportProduct(Request $request)
    {
        return Excel::download(new ProductExport($request), '일반회원 매물_' . Carbon::now() . '.xlsx');
    }
}

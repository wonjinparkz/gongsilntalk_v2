<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * 일반회원 매물 보기
     */
    public function productListView(Request $request): View
    {
        $productList = Product::select();

        $productList->with('images');
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
        $result = Product::with('images', 'users', 'priceInfo', 'productAddInfo', 'productOptions')->where('id', $id)->first();

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
            'is_map' => 'required',
            'address' => 'required',
            'region_code' => 'required',
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
            'building_type' => 'required'

        ]);

        Log::info($request);

        if ($validator->fails()) {
            return redirect(route('admin.product.detail.view', [$request->id]))
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->type) {
            $productDate = [
                'type' => $request->type,
                'is_map' => $request->is_map,
                'address' => $request->address,
                'address_detail' => $request->address_detail,
            ];
        }

        $result = Product::where('id', $request->id)
            ->update($productDate);



        $this->imageWithEdit($request->product_image_ids, Product::class, $request->id);

        return redirect()->to($request->last_url)->with('message', '팝업 내용을 수정했습니다.');
    }
}

<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $result = Product::with('images', 'users', 'priceInfo')->where('id', $id)->first();

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
}

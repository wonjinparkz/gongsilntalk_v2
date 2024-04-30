<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
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

        $productList->whereHas('users', function ($query) use ($request) {
            // 사용자 이름
            if (isset($request->name)) {
                $query->where('users.name', 'like', "%{$request->name}%");
            }
        });



        // 정렬
        $productList->orderBy('product.created_at', 'desc')->orderBy('id', 'desc');

        $result = $productList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.product.product-list', compact('result'));
    }
}

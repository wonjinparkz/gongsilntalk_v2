<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class CorpProductExport implements FromView
{
    use Exportable;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $request = $this->request;

        $productList = Product::select()
            ->where('product.is_delete', '0')
            ->where('product.user_type', '1');



        $productList->whereHas('users', function ($query) use ($request) {
            // 사용자 이름
            if (isset($request->company_name)) {
                $query->where('users.company_name', 'like', "%{$request->company_name}%");
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

        return view('exports.CorpProduct', [
            'result' => $productList->get()
        ]);
    }
}

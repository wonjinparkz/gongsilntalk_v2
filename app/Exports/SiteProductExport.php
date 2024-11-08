<?php

namespace App\Exports;

use App\Models\SiteProduct;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SiteProductExport implements FromView
{
    use Exportable;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {

        $siteProductList = SiteProduct::select()
            ->where('site_product.is_delete', '=', '0');

        // 분양 상태
        if (isset($this->request->is_sale)) {
            $siteProductList->where('site_product.is_sale', $this->request->is_sale);
        }

        // 지역
        if ($this->request->has('region_type')) {
            $regionTypeArray = $this->request->region_type;
            $siteProductList->whereIn('site_product.region_type', $regionTypeArray);
        }

        // 게시 시작일 from ~ to
        if (isset($this->request->from_created_at) && isset($this->request->to_created_at)) {
            $siteProductList->DurationDate('created_at', $this->request->from_created_at, $this->request->to_created_at);
        }

        // 정렬
        $siteProductList->orderBy('site_product.created_at', 'desc')->orderBy('id', 'desc');

        return view('exports.SiteProduct', [
            'result' => $siteProductList->get()
        ]);
    }
}

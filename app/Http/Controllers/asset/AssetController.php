<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AssetController extends Controller
{
    /**
     * 일반 사용자 자산관리 목록 보기
     */
    public function assetListView(Request $request): View
    {
        $assetList = User::where('state', 0)
            ->join('asset_address', 'users.id', '=', 'asset_address.users_id')
            ->join('asset', 'asset_address.id', '=', 'asset.asset_address_id')
            ->select(
                'users.*',
                DB::raw('SUM(asset.price) as total_price'),
                DB::raw('Count(asset.price) as total_count'),
                DB::raw('MAX(asset_address.created_at) as max_created_at')
            )
            ->groupBy('users.id');

        // 정렬
        $assetList->orderBy('max_created_at', 'desc')->orderBy('users.id', 'desc');


        $result = $assetList->paginate($request->per_page == null ? 10 : $request->per_page);
        $result->appends(request()->except('page'));

        // 각 자산의 총 가격을 계산
        // foreach ($result as $asset) {
        //     $asset->total_price = $asset->asset->sum('price');
        // }

        return view('admin.asset.asset-list', compact('result'));
    }

    /**
     * 일반 사용자 자산관리 상세 보기
     */
    public function assetDetailView($id): View
    {
        $user = User::select()
            ->where('users.id', $id)
            ->first();

        $result = AssetAddress::with('user', 'asset')->select()->where('users_id', $id)->orderBy('id', 'desc')->get();

        $addressData = Asset::select(
            DB::raw('MAX(asset.created_at) as max_created_at'),
            DB::raw('SUM(asset.price) AS price'),
            DB::raw('SUM(asset.check_price) AS check_price'),
            DB::raw('SUM(asset.month_price) AS month_price'),
            DB::raw('SUM(asset.loan_price) AS loan_price'),
            DB::raw('SUM(asset.etc_price +asset.tax_price+asset.estate_price) AS etc_price'),
            DB::raw('SUM(IFNULL(((asset.loan_price * (asset.loan_rate / 100)) / 12), 0)) AS loan_rate_price'),
            DB::raw('SUM(IFNULL((asset.price * (asset.acquisition_tax_rate / 100)), 0)) AS acquisition_tax_price')
        )
            ->leftJoin('asset_address', function ($report) use ($id) {
                $report->on('asset_address.id', '=', 'asset.asset_address_id')
                    ->where('asset_address.users_id', '=', $id);
            })
            ->where('asset_address.users_id', '=', $id)
            ->first();

        return view('admin.asset.asset-detail', compact('user', 'result', 'addressData'));
    }
}

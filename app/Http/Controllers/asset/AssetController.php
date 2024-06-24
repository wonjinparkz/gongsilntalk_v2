<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssetController extends Controller
{
    /**
     * 일반 사용자 자산관리 목록 보기
     */
    public function assetListView(Request $request): View
    {
        $assetList = Asset::select();

         // 정렬
         $assetList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

         $result = $assetList->paginate($request->per_page == null ? 10 : $request->per_page);
         $result->appends(request()->except('page'));

        return view('admin.asset.asset-list', compact('result'));
    }
}

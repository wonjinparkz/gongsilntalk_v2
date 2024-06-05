<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\DataStore;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataStoreController extends Controller
{
    /**
     * 상가 목록 보기
     */
    public function storeListView(Request $request): View
    {
        $aptList = DataStore::select();

        // 검색어
        if (isset($request->kaptName)) {
            $aptList->where('data_apt.kaptName', 'like', "%{$request->kaptName}%");
        }

        // 정렬
        $aptList->orderBy('data_apt.created_at', 'desc')->orderBy('id', 'desc');

        $result = $aptList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.store.store-list', compact('result'));
    }

    /**
     * 상가 등록 보기
     */
    public function storeCreateView(): View
    {
        return view('admin.store.store-create');
    }
}

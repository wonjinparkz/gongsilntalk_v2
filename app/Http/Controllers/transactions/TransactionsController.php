<?php

namespace App\Http\Controllers\transactions;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use App\Models\Transactions;
use App\Models\TransactionsRegionUpdate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    /**
     * 아파트 실거래가 목록 보기
     */
    public function transactionsListView(Request $request): View
    {
        $transactionsList = Transactions::select()
            ->where('type', '0');

        // 검색어
        if (isset($request->aptName)) {
            $transactionsList->where('transactions_apt.aptName', 'like', "%{$request->aptName}%");
        }

        // 타겟 유형
        if (isset($request->is_matching)) {
            $transactionsList->where('transactions_apt.is_matching', $request->is_matching);
        }

        // 정렬
        $transactionsList->orderBy('transactions_apt.created_at', 'desc')->orderBy('id', 'desc');

        $result = $transactionsList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        $regionList = TransactionsRegionUpdate::select()->where('type', '0')->get();

        return view('admin.transactions.transactions-list', compact('result', 'regionList'));
    }

    public function transactionsDetailView($id): View
    {
        $result = Transactions::select()->where('id', $id)->first();

        return view('admin.transactions.transactions-detail', compact('result'));
    }

    /**
     * 아파트 실거래가 목록 보기
     */
    public function transactionsRentListView(Request $request): View
    {
        $transactionsList = Transactions::select()
            ->where('type', '1');

        // 검색어
        if (isset($request->aptName)) {
            $transactionsList->where('transactions_apt.aptName', 'like', "%{$request->aptName}%");
        }

        // 타겟 유형
        if (isset($request->is_matching)) {
            $transactionsList->where('transactions_apt.is_matching', $request->is_matching);
        }

        // 정렬
        $transactionsList->orderBy('transactions_apt.created_at', 'desc')->orderBy('id', 'desc');

        $result = $transactionsList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        $regionList = TransactionsRegionUpdate::select()->where('type', '1')->get();

        return view('admin.transactions.transactionsRent-list', compact('result', 'regionList'));
    }

    public function transactionsRentDetailView($id): View
    {
        $result = Transactions::select()->where('id', $id)->first();

        return view('admin.transactions.transactionsRent-detail', compact('result'));
    }
}

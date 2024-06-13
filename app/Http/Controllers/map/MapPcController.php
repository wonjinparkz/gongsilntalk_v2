<?php

namespace App\Http\Controllers\map;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use App\Models\DataBuilding;
use App\Models\DataStore;
use App\Models\KnowledgeCenter;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MapPcController extends Controller
{
    public function map(Request $request): View
    {
        info($request->all());
        $address_lat = $request->input('address_lat') ?? 37.4874462;
        $address_lng = $request->input('address_lng') ?? 126.8913583;
        $zoomLv = $request->input('zoomLv');
        $distance = 0.5; // 500m
        // 클러스터링
        // 전국 8도 지도, 줌인/아웃 레벨 12~10단계 (축적도 32km)
        // 매물 수량 표시 마커 노출
        // 중개사무소 마커 노출X

        // 시군구 4km부터
        // 전국 시/군/구 지도, 줌인/아웃 레벨 9~7단계 (축적도 4km)
        // 매물 수량 표시 마커 노출
        // 중개사무소 마커 노출X

        // 실거래가지도 클러스터링 (줌/인아웃 6레벨)
        // 전국 시/군/구 지도, 줌인/아웃 레벨 6~5단계 (축적도 500m)
        // 매물 수량 표시 마커 노출
        // 중개사무소 개수 마커 노출

        // 전국 시/군/구 지도, 줌인/아웃 레벨 4~1단계 (축적도 100m)
        // 매물 수량 표시 마커 노출
        // 중개사무소 개수 마커 노출
        $maps = Product::select()
            ->where('is_delete', '0')
            ->where('is_blind', '0')
            ->where('is_map', '0')
            ->where('state', '>', '0');



        if (($address_lat && $address_lng && $zoomLv)) {
            $maps->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                [$address_lat, $address_lng, $address_lat, $distance]
            );
        };

        $aptMaps = DataApt::select('data_apt.*', 'data_apt.y as address_lat', 'data_apt.x as address_lng')
            ->where('is_base_info', 1)
            ->where('is_detail_info', 1)
            ->where('is_map_info', 1)
            ->where('as3', '구로동');
        if (($address_lat && $address_lng && $zoomLv)) {
            $aptMaps->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                [$address_lat, $address_lng, $address_lat, $distance]
            );
        };

        $aptMaps = $aptMaps->limit(100)->get();

        $filteredAptMaps = [];
        foreach ($aptMaps as $apt) {
            $transactions = $apt->transactions()
                ->orderByRaw('year DESC, month DESC, day DESC')
                ->first();

            $apt->transactions = $transactions ?? '';
            $filteredAptMaps[] = $apt;

            // if ($transactions) {
            //     $apt->transactions = $transactions;
            //     $filteredAptMaps[] = $apt;
            // }
        }


        $aptMaps = $filteredAptMaps;

        // 검색
        // if ($request->has('type')) {
        //     $maps->whereIn('product.type', $request->type);
        // }
        // 매물종류
        // if ($request->has('type')) {
        //     $maps->whereIn('product.type', $request->type);
        // }
        // 준공연차
        // if ($request->has('type')) {
        //     $maps->whereIn('product.type', $request->type);
        // }
        // 실거래가지도, 매물지도
        // if ($request->has('from_created_at') && $request->has('to_created_at')) {
        //     $maps->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        // }

        $maps = $maps->get();


        // Log::info($maps);

        $knowledges = KnowledgeCenter::select()
            ->where('is_delete', '0')
            ->where('is_blind', '0');

        if (($address_lat && $address_lng && $zoomLv)) {
            $knowledges->where(
                DB::raw("ROUND((6371 * ACOS(COS(RADIANS($address_lat)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS($address_lng)) + SIN(RADIANS($address_lat)) * SIN(RADIANS(address_lat)))), 2)"),
                '<',
                $distance
            );
        };

        $store = DataStore::select('data_store.*', 'data_store.y as address_lat', 'data_store.x as address_lng');

        if (($address_lat && $address_lng && $zoomLv)) {
            $store->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                [$address_lat, $address_lng, $address_lat, $distance]
            );
        };

        $building = DataBuilding::select('data_building.*', 'data_building.y as address_lat', 'data_building.x as address_lng');

        if (($address_lat && $address_lng && $zoomLv)) {
            $building->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                [$address_lat, $address_lng, $address_lat, $distance]
            );
        };

        $knowledges = $knowledges->get();
        $store = $store->get();
        $building = $building->get();

        $data = [
            'maps' => $maps,
            'aptMaps' => $aptMaps,
            'knowledges' => $knowledges,
            'store' => $store,
            'building' => $building,
        ];

        Log::info($data);

        return view('www.map.map', compact('data'));
    }


    public function mapSideView(Request $request): View
    {
        $markerType = $request->type;

        $result = '';

        if ($markerType == 'knowledge') {
            $result = KnowledgeCenter::where('id', $request->id)->first();
        } else if ($markerType == 'apt') {
            $result = DataApt::select('data_apt.*', 'data_apt.y as address_lat', 'data_apt.x as address_lng')->where('id', $request->id)->first();
            if ($result) {
                $result->transactions = $result->transactions()->get(); // 실제 데이터를 가져옵니다.
                $result->transactionsRent = $result->transactionsRent()->get(); // 실제 데이터를 가져옵니다.

                // 준공일
                $transactionWithYear = $result->transactions->first(fn ($t) => !empty($t->constructionYear));
                $transactionRentWithYear = $result->transactionsRent->first(fn ($t) => !empty($t->constructionYear));
                $result->constructionYear = $transactionWithYear->constructionYear ?? $transactionRentWithYear->constructionYear ?? null;

                // 매매 전월세 평수 종류
                $result->exclusiveAreasSale = $result->transactions->pluck('exclusiveArea')
                    ->unique()
                    ->sort()
                    ->values()
                    ->all();

                // 매매 거래 데이터 그룹화
                $result->groupedTransactions = $result->transactions->groupBy('exclusiveArea')->sortKeys();

                // 전월세 거래 데이터 그룹화
                $result->groupedTransactionsRent = $result->transactionsRent->groupBy('exclusiveArea')->sortKeys();
            }
        } else if ($markerType == 'store') {
            $result = DataStore::where('id', $request->id)->first();
        } else if ($markerType == 'building') {
            $result = DataBuilding::where('id', $request->id)->first();
        }

        Log::info($result);

        return view('www.map.mpa-side', compact('result', 'markerType'));
    }
}

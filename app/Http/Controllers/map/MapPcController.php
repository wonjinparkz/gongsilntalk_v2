<?php

namespace App\Http\Controllers\map;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use App\Models\DataBuilding;
use App\Models\DataStore;
use App\Models\KnowledgeCenter;
use App\Models\Product;
use App\Models\RegionCoordinate;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MapPcController extends Controller
{
    public function map(Request $request): View
    {
        return view('www.map.map');
    }

    public function mapMobile(Request $request): View
    {
        return view('www.map.map-mobile');
    }


    public function getMapMarker(Request $request)
    {
        // 요청 받은 모든 데이터 로그에 기록
        info($request->all());

        // 위도와 경도를 요청에서 가져오거나 기본값 설정
        $address_lat = $request->lat ?? 37.4874462;
        $address_lng = $request->lng ?? 126.8913583;
        $zoomLv = $request->zoomLv;
        $distance = 0.1;

        // 마커 표시해줄 매물들 초기 세팅
        $regionList = [];
        $filteredAptMaps = [];
        $knowledges = [];
        $store = [];
        $building = [];

        // 줌 레벨에 따른 클러스터링 처리
        if ($zoomLv <= 12) {
            $distance = 10000;
            $regionList = RegionCoordinate::select('id', 'sido as name', 'address_lat', 'address_lng')
                ->whereNull('sigungu')
                ->whereNull('dong')
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();
            foreach ($regionList as $region) {
                $sido = $region->name;  // $region->sido -> $region->name
                $dongs = RegionCoordinate::select('dong')->where('sido', $sido)->whereNotNull('dong')->pluck('dong')->toArray();

                if (!empty($dongs)) {
                    $average_price = Transactions::whereIn('legalDong', $dongs)
                        ->where('type', 0)
                        ->where('is_matching', 1)
                        ->avg('transactionPrice');

                    $region->average_price = $average_price;
                } else {
                    $region->average_price = null;
                }
            }
        } elseif ($zoomLv >= 11 && $zoomLv <= 13) {
            $distance = 10;
            $regionList = RegionCoordinate::select('id', 'sigungu as name', 'address_lat', 'address_lng')
                ->whereNull('dong')
                ->whereNotNull('sigungu')
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();
            foreach ($regionList as $region) {
                $sigungu = $region->name;  // $region->sigungu -> $region->name
                $dongs = RegionCoordinate::select('dong')->where('sigungu', $sigungu)->whereNotNull('dong')->pluck('dong')->toArray();

                if (!empty($dongs)) {
                    $average_price = Transactions::whereIn('legalDong', $dongs)
                        ->where('type', 0)
                        ->where('is_matching', 1)
                        ->avg('transactionPrice');

                    $region->average_price = $average_price;
                } else {
                    $region->average_price = null;
                }
            }
        } elseif ($zoomLv >= 14 && $zoomLv <= 15) {
            $distance = 2;
            $regionList = RegionCoordinate::select('id', 'dong as name', 'address_lat', 'address_lng')->whereNotNull('dong')
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();
            foreach ($regionList as $region) {
                $dong = $region->name;
                $dongs = RegionCoordinate::select('dong')->where('dong', $dong)->whereNotNull('dong')->pluck('dong')->toArray();

                if (!empty($dongs)) {
                    $average_price = Transactions::whereIn('legalDong', $dongs)
                        ->where('type', 0)
                        ->where('is_matching', 1)
                        ->avg('transactionPrice');

                    $region->average_price = $average_price;
                } else {
                    $region->average_price = null;
                }
            }
        } else {
            $distance = 1;
            // // 매물 데이터를 가져옴
            // $maps = Product::select()
            //     ->where('is_delete', '0')
            //     ->where('is_blind', '0')
            //     ->where('is_map', '0')
            //     ->where('state', '>', '0')
            //     ->whereRaw(
            //         "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
            //         [$address_lat, $address_lng, $address_lat, $distance]
            //     )->get();

            // 아파트 데이터를 가져옴
            $aptMaps = DataApt::select('data_apt.*', 'data_apt.y as address_lat', 'data_apt.x as address_lng')
                ->where('is_base_info', 1)
                ->where('is_detail_info', 1)
                ->where('is_map_info', 1)
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();

            // 아파트 데이터 필터링
            $filteredAptMaps = [];
            foreach ($aptMaps as $apt) {
                $transactions = $apt->transactions()
                    ->orderByRaw('year DESC, month DESC, day DESC')
                    ->first();

                $apt->transactions = $transactions ?? '';
                $filteredAptMaps[] = $apt;
            }

            // 지식 센터 데이터를 가져옴
            $knowledges = KnowledgeCenter::select()
                ->where('is_delete', '0')
                ->where('is_blind', '0')
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();

            // 상점 데이터를 가져옴
            $store = DataStore::select('data_store.*', 'data_store.y as address_lat', 'data_store.x as address_lng')
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();

            // 건물 데이터를 가져옴
            $building = DataBuilding::select('data_building.*', 'data_building.y as address_lat', 'data_building.x as address_lng')
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();
        }

        // 최종 데이터 배열에 저장
        $data = [
            // 'maps' => $maps,
            'region' => $regionList,
            'aptMaps' => $filteredAptMaps,
            'knowledges' => $knowledges,
            'store' => $store,
            'building' => $building,
        ];

        // JSON 형태로 응답 반환
        return response()->json(compact('data'));
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


    public function m_map()
    {
    }
}

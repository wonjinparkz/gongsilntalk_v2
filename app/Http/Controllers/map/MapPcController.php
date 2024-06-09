<?php

namespace App\Http\Controllers\map;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
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
            ->where('is_map_info', 1);
        if (($address_lat && $address_lng && $zoomLv)) {
            $aptMaps->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                [$address_lat, $address_lng, $address_lat, $distance]
            );
        };

        $aptMaps = $aptMaps->limit(100)->get();

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

        $knowledges = $knowledges->get();

        $data = [
            'maps' => $maps,
            'aptMaps' => $aptMaps,
            'knowledges' => $knowledges,
        ];

        Log::info(json_encode($data, JSON_PRETTY_PRINT));

        return view('www.map.map', compact('data'));
    }
}

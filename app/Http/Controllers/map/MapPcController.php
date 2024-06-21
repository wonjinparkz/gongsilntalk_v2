<?php

namespace App\Http\Controllers\map;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use App\Models\DataBuilding;
use App\Models\DataStore;
use App\Models\KnowledgeCenter;
use App\Models\Product;
use App\Models\RecentProduct;
use App\Models\RegionCoordinate;
use App\Models\Transactions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MapPcController extends Controller
{
    public function map(Request $request): View
    {
        return view('www.map.map');
    }

    // 모바일 맵
    public function mapMobile(Request $request): View
    {
        return view('www.map.map-mobile');
    }

    // 모바일 맵 상세
    public function mapDetailMobile(Request $request): View
    {

        return view('www.map.map-detail-mobile');
    }

    // 모바일 지도 내 매물목록
    public function mapPropertyList(Request $request)
    {
        info(json_encode($request->all()) . 'request');
        // 목록 기준
        // 가(임시)주소인 경우 지도/목록에 노출하지 않는다.
        // 사용자가 등록 후 관리자의 의해 수정이 완료되어 등록된 매물 과 중개인이 등록한 매물을 노출한다.
        // 지도 영역 내 매물 전부 노출  지도에 검색 된 모든 매물 수의 합합
        // 매물 목록 노출 범위 기준: 줌인/아웃 레벨에 따라(ex. 전국이면 전국 매물 목록)
        // 포함 정보 정렬 기준: 최신순이 default
        // 개수제한 : 없음 -> ex) 10,243개일 경우 그대로 표시

        // 일반회원 +  중개사회원 매물 목록 보기
        if ($request->productIds) {
            $propertyList = Product::select('product.*')->with('priceInfo', 'productAddInfo', 'productOptions', 'productServices', 'users')
                ->where('is_delete', '0')
                ->like('product', Auth::guard('web')->user()->id ?? "");
            // 정렬
            switch ($request->orderby) {
                case 'sort_new':
                    $propertyList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc');
                    break;
                case 'price_desc':
                    $propertyList->Leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
                        ->orderBy('product_price.price', 'asc')
                        ->select('product.*');
                    break;
                case 'price_asc':
                    $propertyList->Leftjoin('product_price', 'product.id', '=', 'product_price.product_id')
                        ->orderBy('product_price.price', 'desc')
                        ->select('product.*');
                    break;
                case 'area_asc':
                    $propertyList->orderBy('exclusive_square', 'desc')->orderBy('product.id', 'desc');
                    break;
                case 'area_desc':
                    $propertyList->orderBy('exclusive_square', 'asc')->orderBy('product.id', 'desc');
                    break;
                default:
                    $propertyList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc');
                    break;
            }

            $propertyList->whereIn('product.id', $request->productIds);
            $propertyList = $propertyList->get();
        } else {
            $propertyList = collect();
        }


        // 중개사무소 목록 보기
        if ($request->agentIds) {
            $agentList = User::with('images')
                ->where('type', '1')
                ->where('company_state', '1')
                ->whereIn('users.id', $request->agentIds)
                ->get();
        } else {
            $agentList = collect();
        }

        info($agentList);

        if ($request->ajax()) {
            $property = view('components.m-property-layout', compact('propertyList'))->render();
            $agent = view('components.m-agent-layout', compact('agentList'))->render();
            return response()->json(['property' => $property, 'agent' => $agent]);
        }

        return view('www.map.map-property-list-mobile', compact('propertyList', 'agentList'));
    }

    // 매물 상세
    public function mapRoomDetail(Request $request)
    {
        $product = Product::select('product.*')->with('priceInfo', 'productAddInfo', 'productOptions', 'productServices', 'users')->where('product.id', $request->id);

        // 좋아요
        if (Auth::guard('web')->user() != null) {
            $product->like('product', Auth::guard('web')->user()->id ?? "");
        }

        $result = $product->first();

        // 최근 본 매물 등록
        if (Auth::guard('web')->check()) {
            $check = RecentProduct::where('users_id', Auth::guard('web')->user()->id)
                ->where('product_id', $request->id)
                ->where('product_type', 'product')->first();

            if ($check == null) {
                $recent_product = RecentProduct::create([
                    'users_id' => Auth::guard('web')->user()->id,
                    'product_id' => $request->id,
                    'product_type' => 'product',
                ]);
            }
        }
        return view('www.map.room-detail', compact('result'));
    }

    // 중개사무소 상세
    public function mapAgentDetail(Request $request)
    {
        $result = User::select()->where('type', '1')->where('company_state', '1')->first();

        $product = Product::select('product.*', 'product_price.payment_type')->with('users', 'priceInfo')
            ->leftjoin('product_price', 'product_price.product_id', 'product.id')
            ->where('is_delete', '0')
            ->where('user_type', '1');

        // 매매/전세/월세 등 여부
        if (isset($request->payment_type)) {
            $product->where('product_price.payment_type', $request->payment_type);
        }

        // 좋아요
        if (Auth::guard('web')->user() != null) {
            $product->like('product', Auth::guard('web')->user()->id ?? "");
        }

        // 정렬
        $product->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc');

        $count = $product->count();
        $productList = $product->paginate(10);
        if ($request->ajax()) {
            $view = view('components.corp-product-list', compact('productList'))->render();
            return response()->json(['html' => $view, 'count' => $count]);
        }
        return view('www.map.agent-detail', compact('result'));
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
        $knowledgesBundle = [];

        $product = [];
        $agent = [];

        if ($request->mapType == 0) {
            if ($zoomLv >= 15 && $zoomLv <= 13) {
            }

            // 줌 레벨에 따른 클러스터링 처리
            if ($zoomLv <= 10) {
                $distance = 500;
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
                $distance = 20;
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
                $distance = 8;
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
                if (!isset($request->sale_product_type) || $request->sale_product_type == 3) {
                    $aptMaps = DataApt::select('data_apt.*', 'data_apt.y as address_lat', 'data_apt.x as address_lng')
                        ->where('is_base_info', 1)
                        ->where('is_detail_info', 1)
                        ->where('is_map_info', 1)
                        ->whereRaw(
                            "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                            [$address_lat, $address_lng, $address_lat, $distance]
                        );
                    if ($request->useDate > 0) {
                        $currentYear = Carbon::now()->year;
                        if ($request->useDate == 1) {
                            $lastYear = $currentYear - 1;
                            $aptMaps->whereRaw('YEAR(kaptUsedate) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 2) {
                            $lastYear = $currentYear - 2;
                            $aptMaps->whereRaw('YEAR(kaptUsedate) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 3) {
                            $lastYear = $currentYear - 5;
                            $aptMaps->whereRaw('YEAR(kaptUsedate) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 4) {
                            $lastYear = $currentYear - 10;
                            $aptMaps->whereRaw('YEAR(kaptUsedate) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 5) {
                            $lastYear = $currentYear - 15;
                            $aptMaps->whereRaw('YEAR(kaptUsedate) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 6) {
                            $lastYear = $currentYear - 15;
                            $aptMaps->whereRaw('YEAR(kaptUsedate) < ?', [$lastYear]);
                        }
                    }
                    $aptMaps = $aptMaps->get();

                    // 아파트 데이터 필터링
                    $filteredAptMaps = [];
                    foreach ($aptMaps as $apt) {
                        $transactions = $apt->transactions()
                            ->orderByRaw('year DESC, month DESC, day DESC')
                            ->first();

                        $apt->transactions = $transactions ?? '';
                        $filteredAptMaps[] = $apt;
                    }
                }
                if (!isset($request->sale_product_type) || $request->sale_product_type == 0) {
                    // 지식 센터 데이터를 가져옴
                    $knowledges = KnowledgeCenter::select()
                        ->where('is_delete', '0')
                        ->where('is_blind', '0')
                        ->whereRaw(
                            "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                            [$address_lat, $address_lng, $address_lat, $distance]
                        )->get();
                }
                if (!isset($request->sale_product_type) || $request->sale_product_type == 1) {
                    // 상가 데이터를 가져옴
                    $store = DataStore::select('data_store.*', 'data_store.y as address_lat', 'data_store.x as address_lng')
                        ->whereRaw(
                            "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                            [$address_lat, $address_lng, $address_lat, $distance]
                        )->get();
                }
                if (!isset($request->sale_product_type) || $request->sale_product_type == 2) {
                    // 건물 데이터를 가져옴
                    $building = DataBuilding::select('data_building.*', 'data_building.y as address_lat', 'data_building.x as address_lng')
                        ->whereRaw(
                            "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(y)) * COS(RADIANS(x) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(y)))), 2) < ?",
                            [$address_lat, $address_lng, $address_lat, $distance]
                        )->get();
                }
            }
        } else if ($request->mapType == 1) {
            if ($zoomLv <= 11) {
                $distance = 1000;
            } elseif ($zoomLv >= 11 && $zoomLv <= 13) {
                $distance = 50;
            } elseif ($zoomLv >= 14 && $zoomLv <= 15) {
                $distance = 2;
            } else {
                $distance = 1;
            }
            $product = Product::select()->where('state', 1)
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                );

            if (isset($request->product_type)) {
                $product->where('product.type', $request->product_type);
            }

            $product->whereHas('priceInfo', function ($query) use ($request) {
                // 거래유형
                $paymentTypes = explode(',', $request->payment_type);
                if (isset($request->payment_type)) {
                    $query->whereIn('product_price.payment_type', $paymentTypes);
                }
                // 가격
                if (isset($request->price)) {
                    $priceArray = explode(',', $request->price);
                    if ($priceArray[0] > 0) {
                        Log::info('ddjdldj');
                        $query->where('product_price.price', '>=', $priceArray[0] * 100000000);
                    }
                    if ($priceArray[1] < 200) {
                        $query->where('product_price.price', '<=', $priceArray[1] * 100000000);
                    }
                }
            });

            $product = $product->get();

            $agent = User::select('users.id', 'company_address_lat', 'company_address_lng')->with('image')->where('type', 1)->where('state', 0)->where('company_state', 1)
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(company_address_lat)) * COS(RADIANS(company_address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(company_address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                )->get();
        }

        // 현재 내 좌표에 가장 가까운 읍면동 꺼내오기
        $centerDongName = RegionCoordinate::select('*', DB::raw("(6371 * acos(cos(radians($address_lat)) * cos(radians(address_lat)) * cos(radians(address_lng) - radians($address_lng)) + sin(radians($address_lat)) * sin(radians(address_lat)))) AS distance"))
            ->whereNotNull('dong')
            ->orderBy('distance')
            ->limit(1)
            ->first();

        // 최종 데이터 배열에 저장
        $data = [
            // 'maps' => $maps,
            'region' => $regionList,
            'aptMaps' => $filteredAptMaps,
            'knowledges' => $knowledges,
            'store' => $store,
            'building' => $building,
            'centerDongName' => $centerDongName,
            'product' => $product,
            'agent' => $agent,
        ];

        // JSON 형태로 응답 반환
        return response()->json(compact('data'));
    }

    public function mapSideView(Request $request): View
    {
        Log::info($request);
        $mapType = $request->mapType;
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

        $productList = Product::where('state', 1)
            ->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                [$result->address_lat, $result->address_lng, $result->address_lat, 10000]
            )->limit(3)->get();

        $result->productList = $productList;

        return view('www.map.map-side', compact('result', 'markerType'));
    }
}

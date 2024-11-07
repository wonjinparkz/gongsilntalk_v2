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
        $markerId = $request->markerId ?? '';
        $markerType = $request->markerType ?? '';

        $mapType = $request->mapType ?? 0;
        $lat = $request->lat ?? 37.2109494;
        $lng = $request->lng ?? 127.0922858;

        return view('www.map.map', compact('mapType', 'lat', 'lng', 'markerId', 'markerType'));
    }

    // 모바일 맵
    public function mapMobile(Request $request): View
    {
        $markerId = $request->markerId ?? '';
        $markerType = $request->markerType ?? '';

        $mapType = $request->mapType ?? 0;
        $lat = $request->lat ?? 37.2109494;
        $lng = $request->lng ?? 127.0922858;
        $search_name = $request->search_name ?? '';

        return view('www.map.map-mobile', compact('mapType', 'lat', 'lng', 'search_name', 'markerId', 'markerType'));
    }

    // 모바일 지도 내 매물목록
    public function mapPropertyList(Request $request)
    {
        // 목록 기준
        // (구)주소인 경우 지도/목록에 노출하지 않는다.
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
        $result = User::select()->where('type', '1')->where('company_state', '1')->where('id', $request->id)->first();

        $product = Product::select('product.*', 'product_price.payment_type')->with('users', 'priceInfo')
            ->leftjoin('product_price', 'product_price.product_id', 'product.id')
            ->where('is_delete', '0')
            ->where('user_type', '1');

        // 매매/전세/월세 등 여부
        if (isset($request->payment_type)) {
            $product->where('product_price.payment_type', $request->payment_type);
        }
        if (isset($request->id)) {
            $product->where('product.users_id', $request->id);
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
                $distance = 30;
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
                if (!isset($request->sale_product_type) || $request->sale_product_type == 0) {
                    // 지식 센터 데이터를 가져옴
                    $knowledges = KnowledgeCenter::select()
                        ->where('is_delete', '0')
                        ->where('is_blind', '0')
                        ->whereRaw(
                            "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                            [$address_lat, $address_lng, $address_lat, $distance]
                        );

                    if ($request->useDate > 0) {
                        $currentYear = Carbon::now()->year;
                        if ($request->useDate == 1) {
                            $lastYear = $currentYear - 1;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 2) {
                            $lastYear = $currentYear - 2;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 3) {
                            $lastYear = $currentYear - 5;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 4) {
                            $lastYear = $currentYear - 10;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 5) {
                            $lastYear = $currentYear - 15;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 6) {
                            $lastYear = $currentYear - 15;
                            $knowledges->whereRaw('YEAR(completion_date) < ?', [$lastYear]);
                        }
                    }
                    $knowledges = $knowledges->get();
                }
            } elseif ($zoomLv >= 14 && $zoomLv <= 15) {
                $distance = 10;
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
                if (!isset($request->sale_product_type) || $request->sale_product_type == 0) {
                    // 지식 센터 데이터를 가져옴
                    $knowledges = KnowledgeCenter::select()
                        ->where('is_delete', '0')
                        ->where('is_blind', '0')
                        ->whereRaw(
                            "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                            [$address_lat, $address_lng, $address_lat, $distance]
                        );

                    if ($request->useDate > 0) {
                        $currentYear = Carbon::now()->year;
                        if ($request->useDate == 1) {
                            $lastYear = $currentYear - 1;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 2) {
                            $lastYear = $currentYear - 2;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 3) {
                            $lastYear = $currentYear - 5;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 4) {
                            $lastYear = $currentYear - 10;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 5) {
                            $lastYear = $currentYear - 15;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 6) {
                            $lastYear = $currentYear - 15;
                            $knowledges->whereRaw('YEAR(completion_date) < ?', [$lastYear]);
                        }
                    }
                    $knowledges = $knowledges->get();
                }
            } else {
                $distance = 1.5;

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
                        );

                    if ($request->useDate > 0) {
                        $currentYear = Carbon::now()->year;
                        if ($request->useDate == 1) {
                            $lastYear = $currentYear - 1;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 2) {
                            $lastYear = $currentYear - 2;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 3) {
                            $lastYear = $currentYear - 5;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 4) {
                            $lastYear = $currentYear - 10;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 5) {
                            $lastYear = $currentYear - 15;
                            $knowledges->whereRaw('YEAR(completion_date) >= ?', [$lastYear]);
                        } elseif ($request->useDate == 6) {
                            $lastYear = $currentYear - 15;
                            $knowledges->whereRaw('YEAR(completion_date) < ?', [$lastYear]);
                        }
                    }

                    $knowledges = $knowledges->get();
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
                $distance = 500;
            } elseif ($zoomLv >= 11 && $zoomLv <= 13) {
                $distance = 30;
            } elseif ($zoomLv >= 14 && $zoomLv <= 15) {
                $distance = 10;
            } else {
                $distance = 1.5;
            }

            $product = Product::select('*', DB::raw('address_lat + 0.0002 as address_lat'))->where('state', 1)
                ->whereRaw(
                    "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                    [$address_lat, $address_lng, $address_lat, $distance]
                );

            if (isset($request->product_type)) {
                if ($request->product_type == '0,1,2') {
                    $productTypes = explode(',', $request->product_type);
                    $product->whereIn('product.type', $productTypes);
                } else {
                    $product->where('product.type', $request->product_type);
                }
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
                        $query->where('product_price.price', '>=', $priceArray[0] * 100000000);
                    }
                    if ($priceArray[1] < 200) {
                        $query->where('product_price.price', '<=', $priceArray[1] * 100000000);
                    }
                }
                // 임대료
                if (isset($request->month_price)) {
                    if (array_intersect([1, 2, 4], $paymentTypes)) {
                        $monthPriceArray = explode(',', $request->month_price);
                        if ($monthPriceArray[0] > 0) {
                            $query->where('product_price.month_price', '>=', $monthPriceArray[0] * 10000);
                        }
                        if ($monthPriceArray[1] < 1000) {
                            $query->where('product_price.month_price', '<=', $monthPriceArray[1] * 10000);
                        }
                    }
                }

                //권리금
                if (isset($request->premium_price)) {
                    $premiumPriceArray = explode(',', $request->premium_price);
                    if ($premiumPriceArray[0] > 0) {
                        $query->where('product_price.premium_price', '>=', $premiumPriceArray[0] * 10000);
                    }
                    if ($premiumPriceArray[1] < 10000) {
                        $query->where('product_price.premium_price', '<=', $premiumPriceArray[1] * 10000);
                    }
                }
            });


            // 평수
            if (isset($request->area)) {
                $areaArray = explode(',', $request->area);
                if ($areaArray[0] > 0) {
                    $product->where('product.area', '>=', $areaArray[0]);
                }
                if ($areaArray[1] < 1000) {
                    $product->where('product.area', '<=', $areaArray[1]);
                }
            }

            // 제곱미터
            if (isset($request->square)) {
                $squareArray = explode(',', $request->square);
                if ($squareArray[0] > 0) {
                    $product->where('product.square', '>=', $squareArray[0]);
                }
                if ($squareArray[1] < 1000) {
                    $product->where('product.square', '<=', $squareArray[1]);
                }
            }

            // 관리비
            if (isset($request->service_price)) {
                $servicePriceArray = explode(',', $request->service_price);
                if ($servicePriceArray[0] > 0) {
                    $product->where('product.service_price', '>=', $servicePriceArray[0] * 10000);
                }
                if ($servicePriceArray[1] < 50 && $servicePriceArray[0] > 0) {
                    $product->where('product.service_price', '<=', $servicePriceArray[1] * 10000);
                } else if ($servicePriceArray[1] < 50 && $servicePriceArray[0] == 0) {
                    $product->where(function ($query) use ($servicePriceArray) {
                        $query->where('product.service_price', '<=', $servicePriceArray[1] * 10000)
                            ->orWhereNull('product.service_price');
                    });
                }
            }

            // 사용승인
            if (isset($request->approve_date)) {
                $approveDateArray = explode(',', $request->approve_date);
                $minYears = (int)$approveDateArray[0]; // 최소 연도 값
                $maxYears = (int)$approveDateArray[1]; // 최대 연도 값

                // 현재 날짜
                $currentDate = Carbon::now();

                // 종료 날짜 (최소 연도만큼 전)
                $endDate = $currentDate->copy()->subYears($minYears)->endOfYear()->format('Ymd');

                // 쿼리 빌더 조건 추가
                $product->where(function ($query) use ($endDate, $maxYears) {
                    // 종료 날짜까지의 데이터를 검색 (최대값이 10이면 시작 날짜 제한 없음)
                    if ($maxYears == 10) {
                        $query->where('product.approve_date', '<=', $endDate);
                    } else {
                        $startDate = Carbon::now()->copy()->subYears($maxYears)->startOfYear()->format('Ymd');
                        $query->whereBetween('product.approve_date', [$startDate, $endDate]);
                    }
                });

                // 최소 연도가 0인 경우, 승인 연도가 없는 경우도 포함
                if ($minYears == 0) {
                    $product->orWhereNull('product.approve_date');
                }
            }
            // 융자금
            if (isset($request->loan_type)) {
                $product->where('product.loan_type', $request->loan_type);
            }

            $product->whereHas('productAddInfo', function ($query) use ($request) {
                // 거래유형
                if (isset($request->business_type)) {
                    $businessTypes = explode(',', $request->business_type);
                    $query->whereIn('product_add_info.recommend_business_type', $businessTypes);
                }
                // 기타 층고
                if (isset($request->floor_height_type)) {
                    $query->where('product_add_info.floor_height_type', $request->floor_height_type);
                }
                // 기타 사용전력
                if (isset($request->wattage_type)) {
                    $query->where('product_add_info.wattage_type', $request->wattage_type);
                }
            });


            $product = $product->get();

            $agent = User::select('users.id', 'company_address_lng', DB::raw('company_address_lat - 0.0002 as company_address_lat'))->with('image')->where('type', 1)->where('state', 0)->where('company_state', 1)
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
        $mapType = $request->mapType;
        $markerType = $request->type;

        $result = '';

        if ($markerType == 'knowledge') {
            $result = KnowledgeCenter::with('BrTitleInfo', 'BrRecapTitleInfo', 'BrFlrOulnInfo', 'BrExposInfo', 'BrExposPubuseAreaInfo')->where('id', $request->id)->first();
        } else if ($markerType == 'apt') {
            $result = DataApt::select('data_apt.*', 'data_apt.y as address_lat', 'data_apt.x as address_lng')->where('id', $request->id)->first();
            if ($result) {
                $result->transactions = $result->transactions()->get(); // 실제 데이터를 가져옵니다.
                $result->transactionsRent = $result->transactionsRent()->get(); // 실제 데이터를 가져옵니다.

                // 준공일
                $transactionWithYear = $result->transactions->first(fn($t) => !empty($t->constructionYear));
                $transactionRentWithYear = $result->transactionsRent->first(fn($t) => !empty($t->constructionYear));
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
            $result = DataStore::select('data_store.*', 'data_store.y as address_lat', 'data_store.x as address_lng')->where('id', $request->id)->first();
        } else if ($markerType == 'building') {
            $result = DataBuilding::select('data_building.*', 'data_building.y as address_lat', 'data_building.x as address_lng')->where('id', $request->id)->first();
        }

        $productList = Product::where('state', 1)
            ->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                [$result->address_lat, $result->address_lng, $result->address_lat, 1]
            )->limit(3)->get();

        $result->productList = $productList;

        return view('www.map.map-side', compact('result', 'markerType'));
    }

    // 모바일 아파트 상세
    public function mapMobileProductDetail(Request $request)
    {
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
                $transactionWithYear = $result->transactions->first(fn($t) => !empty($t->constructionYear));
                $transactionRentWithYear = $result->transactionsRent->first(fn($t) => !empty($t->constructionYear));
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
            $result = DataStore::select('data_store.*', 'data_store.y as address_lat', 'data_store.x as address_lng')->where('id', $request->id)->first();
        } else if ($markerType == 'building') {
            $result = DataBuilding::select('data_building.*', 'data_building.y as address_lat', 'data_building.x as address_lng')->where('id', $request->id)->first();
        }

        $productList = Product::where('state', 1)
            ->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                [$result->address_lat, $result->address_lng, $result->address_lat, 1]
            )->limit(3)->get();

        $result->productList = $productList;

        $view = '';
        if ($markerType == 'apt') {
            $view = view('components.m-apt-detail', compact('result'))->render();
        } else if ($markerType == 'knowledge') {
            $view = view('components.m-knowledge-detail', compact('result'))->render();
        } else if ($markerType == 'store') {
            $view = view('components.m-store-detail', compact('result'))->render();
        } else if ($markerType == 'building') {
            $view = view('components.m-building-detail', compact('result'))->render();
        }
        return response()->json(['html' => $view]);
    }
}

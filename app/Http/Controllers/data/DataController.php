<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\BrExposInfo;
use App\Models\BrExposPubuseAreaInfo;
use App\Models\BrFlrOulnInfo;
use App\Models\BrRecapTitleInfo;
use App\Models\BrTitleInfo;
use App\Models\DataApt;
use App\Models\RegionCoordinate;
use App\Models\Transactions;
use App\Models\TransactionsRegionUpdate;
use DateTime;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\DateFormatter;

class DataController extends Controller
{
    /**
     * 화면 조회
     */
    public function getApt()
    {
        // API 연동
        $url = "http://apis.data.go.kr/1613000/AptListService2/getTotalAptList";

        $param = [
            'serviceKey' => 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==',
            'numOfRows' => '100000'
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response|TransferException $response) {
                $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $jsonDecode = json_decode($json, true);
                $body = $jsonDecode['body'];
                $items = $body['items'];
                $item = $items['item'];

                $originItem = [];

                foreach ($item as $value) {
                    $obj = [
                        'as1' => isset($value['as1']) ? trim($value['as1']) : '',
                        'as2' => isset($value['as2']) ? trim($value['as2']) : '',
                        'as3' => isset($value['as3']) ? trim($value['as3']) : '',
                        'as4' => isset($value['as4']) ? trim($value['as4']) : '',
                        'bjdCode' => $value['bjdCode'],
                        'kaptCode' => $value['kaptCode'],
                        'kaptName' => $value['kaptName'],
                    ];
                    array_push($originItem, $obj);
                }

                foreach (array_chunk($originItem, 1000) as $t) {
                    DataApt::upsert($t, 'kaptCode');
                }
            }
        );
        $promise->wait();
    }

    public function getAptBaseInfo()
    {
        $baseInfo = DataApt::where('is_base_info', 0)->first();

        // 베이스 정보가 없을 때
        if ($baseInfo->isEmpty()) {
            return;
        }

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusBassInfo";
        $serviceKey = 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==';

        $batchSize = 100; // 한 번에 처리할 배치 크기
        $delay = 5; // 각 배치 사이의 딜레이 (초)

        $baseInfoChunks = $baseInfo->chunk($batchSize);

        foreach ($baseInfoChunks as $chunk) {
            $promises = [];

            foreach ($chunk as $base) {

                $param = [
                    'serviceKey' => $serviceKey,
                    'kaptCode' => $base->kaptCode
                ];

                $promises[] = Http::async()->get($url, $param)->then(
                    function ($response) use ($base) {
                        try {
                            $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                            $json = json_encode($xml);
                            $jsonDecode = json_decode($json, true);

                            if (isset($jsonDecode['body']) && isset($jsonDecode['body']['item'])) {
                                $body = $jsonDecode['body'];
                                $item = $body['item'];
                                $item['is_base_info'] = 1;
                                $base->update($item);
                                Log::info('$item : ' . json_encode($item));
                            } else {
                                Log::error('Invalid response structure: ' . json_encode($jsonDecode));
                                return back()->with('message', '아파트 단지 정보를 불러오기 실패하였습니다.');
                            }
                        } catch (\Exception $e) {
                            Log::error('Exception while processing response for kaptCode ' . $base->kaptCode . ': ' . $e->getMessage());
                        }
                    },
                    function ($exception) use ($base) {
                        if ($exception instanceof \GuzzleHttp\Exception\ConnectException) {
                            Log::error('Connection error for kaptCode ' . $base->kaptCode . ': ' . $exception->getMessage());
                        } elseif ($exception instanceof \GuzzleHttp\Exception\RequestException) {
                            Log::error('HTTP Request failed for kaptCode ' . $base->kaptCode . ': ' . $exception->getMessage());
                            if ($exception->hasResponse()) {
                                Log::error('Response: ' . $exception->getResponse()->getBody()->getContents());
                            }
                        } else {
                            Log::error('Unexpected exception for kaptCode ' . $base->kaptCode . ': ' . get_class($exception) . ': ' . $exception->getMessage());
                        }
                    }
                );
            }

            // 모든 프라미스를 대기
            foreach ($promises as $promise) {
                $promise->wait();
            }

            // 딜레이 추가
            sleep($delay);
        }
    }


    public function getAptDetailInfo()
    {
        // 최대 실행 시간 설정 (예: 300초)
        // set_time_limit(300);

        $allDetailInfo = DataApt::where('is_detail_info', 0)->limit(3000)->get();

        // 베이스 정보가 없을 때
        if ($allDetailInfo->isEmpty()) {
            return;
        }

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusDtlInfo";
        $serviceKey = 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==';

        $batchSize = 100; // 한 번에 처리할 배치 크기
        $delay = 5; // 각 배치 사이의 딜레이 (초)

        $allDetailInfoChunks = $allDetailInfo->chunk($batchSize);

        foreach ($allDetailInfoChunks as $chunk) {
            $promises = [];

            foreach ($chunk as $detailInfo) {

                $param = [
                    'serviceKey' => $serviceKey,
                    'kaptCode' => $detailInfo->kaptCode
                ];

                $promises[] = Http::async()->get($url, $param)->then(
                    function (Response $response) use ($detailInfo) {
                        try {
                            $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                            $json = json_encode($xml);
                            $jsonDecode = json_decode($json, true);

                            if (isset($jsonDecode['body']) && isset($jsonDecode['body']['item'])) {
                                $body = $jsonDecode['body'];
                                $item = $body['item'];
                                $item['is_detail_info'] = 1;
                                $detailInfo->update($item);
                            } else {
                                Log::error('Invalid response structure: ' . json_encode($jsonDecode));
                                return back()->with('message', '아파트 단지 정보를 불러오기 실패하였습니다.');
                            }
                        } catch (\Exception $e) {
                            Log::error('Exception: ' . $e->getMessage());
                        }
                    },
                    function (ConnectionException $exception) use ($detailInfo) {
                        Log::error('Connection error for kaptCode ' . $detailInfo->kaptCode . ': ' . $exception->getMessage());
                    }
                );
            }

            // 모든 프라미스를 대기
            foreach ($promises as $promise) {
                $promise->wait();
            }

            // 딜레이 추가
            sleep($delay);
        }
    }

    // 아파트 지도 정보 위도 경도 - 네이버
    public function getAptMapInfo()
    {
        // 최대 실행 시간 설정 (예: 3000초)
        set_time_limit(3000);

        $mapInfo = DataApt::where('is_map_info', 0)->where('is_detail_info', 1)->limit(3000)->get();

        if ($mapInfo->isEmpty()) {
            return;
        }


        $batchSize = 100; // 한 번에 처리할 배치 크기
        $delay = 5; // 각 배치 사이의 딜레이 (초)

        $mapInfoChunks = $mapInfo->chunk($batchSize);

        foreach ($mapInfoChunks as $chunk) {
            $promises = [];

            foreach ($chunk as $map) {
                $address = $map->doroJuso == null ? implode(' ', array_slice(explode(' ', $map->kaptAddr), 2)) : $map->doroJuso;

                $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode";
                $param = [
                    'query' => $address
                ];

                $promises[] = Http::withHeaders([
                    'X-NCP-APIGW-API-KEY-ID' => 'iipoiiuz42',
                    'X-NCP-APIGW-API-KEY' => '733JkOIwJF6wOkI66OWBe8jDen72TrzP6qbTSkbP',
                    'Accept' => 'application/json'
                ])->async()->get($url, $param)->then(
                    function (Response|TransferException $response) use ($map) {
                        $jsonDecode = json_decode($response->body(), true);
                        $addresses = $jsonDecode['addresses'];
                        if (count($addresses) > 0) {
                            $address = $addresses[0];
                            $obj = [
                                'is_map_info' => 1,
                                'x' => $address['x'],
                                'y' => $address['y'],
                            ];
                            $map->update($obj);
                        } else {
                            $obj = [
                                'is_map_info' => 1,
                            ];
                            $map->update($obj);
                        }
                    }
                );
            }

            // 모든 프라미스를 대기
            foreach ($promises as $promise) {
                $promise->wait();
            }

            // 딜레이 추가
            sleep($delay);
        }
    }


    /**
     * 아파트 매매 실거래가 정보 불러오기
     */
    public function getTransactionsApt(Request $request)
    {
        // API 연동

        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'region_id' => 'required',
            'year' => 'required',
            'month' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect(route('admin.transactions.list.view'))
                ->withErrors($validator)
                ->withInput()
                ->with('error', '아파트 매매 실거래가를 불러오기를 실패하였습니다.');
        }

        $newLastUpdatedAt = $request->year . str_pad($request->month, 2, '0', STR_PAD_LEFT);

        $region = TransactionsRegionUpdate::select()->where('type', '0')->where('id', $request->region_id)->first();

        if (strtotime($newLastUpdatedAt) > strtotime($region->last_updated_at)) {
            $region->update([
                'last_updated_at' => $newLastUpdatedAt,
            ]);
        }

        $url = "http://openapi.molit.go.kr/OpenAPI_ToolInstallPackage/service/rest/RTMSOBJSvc/getRTMSDataSvcAptTradeDev";

        $param = [
            'serviceKey' => '58+BxzpkxifZ5RGHKDirbnr5Y3l1iK7+y6WxyiyR6sIp8jwIMXeQDAi8zXNY+kyFHznaAHVFxb33c40XOGqaqg==',
            'numOfRows' => '20000',
            'LAWD_CD' => $region->lawd_cd,
            'DEAL_YMD' => $newLastUpdatedAt,
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response|TransferException $response) {
                $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $jsonDecode = json_decode($json, true);
                $header = $jsonDecode['header'];
                $body = $jsonDecode['body'];
                $items = $body['items'];
                $item = $items['item'] ?? [];
                $originItem = [];
                if ($header['resultCode'] == "00") {
                    foreach ($item as $value) {

                        $obj = [
                            'type' => '0',
                            'transactionPrice' => isset($value['거래금액']) ? trim($value['거래금액']) : '',
                            'constructionYear' => isset($value['건축년도']) ? trim($value['건축년도']) : '',
                            'year' => isset($value['년']) ? trim($value['년']) : '',
                            'roadName' => isset($value['도로명']) ? trim($value['도로명']) : '',
                            'roadBuildingMainCode' => isset($value['도로명건물본번호코드']) ? trim($value['도로명건물본번호코드']) : '',
                            'roadBuildingSubCode' => isset($value['도로명건물부번호코드']) ? trim($value['도로명건물부번호코드']) : '',
                            'roadCityCode' => isset($value['도로명시군구코드']) ? trim($value['도로명시군구코드']) : '',
                            'roadSerialCode' => isset($value['도로명일련번호코드']) ? trim($value['도로명일련번호코드']) : '',
                            'roadUpDownCode' => isset($value['도로명지상지하코드']) ? trim($value['도로명지상지하코드']) : '',
                            'roadCode' => isset($value['도로명코드']) ? trim($value['도로명코드']) : '',
                            'legalDong' => isset($value['법정동']) ? trim($value['법정동']) : '',
                            'legalDongMainNumberCode' => isset($value['법정동본번코드']) ? trim($value['법정동본번코드']) : '',
                            'legalDongSubNumberCode' => isset($value['법정동부번코드']) ? trim($value['법정동부번코드']) : '',
                            'legalDongCityCode' => isset($value['법정동시군구코드']) ? trim($value['법정동시군구코드']) : '',
                            'legalDongDistrictCode' => isset($value['법정동읍면동코드']) ? trim($value['법정동읍면동코드']) : '',
                            'legalDongCode' => isset($value['법정동지번코드']) ? trim($value['법정동지번코드']) : '',
                            'aptName' => isset($value['아파트']) ? trim($value['아파트']) : '',
                            'month' => isset($value['월']) ? trim($value['월']) : '',
                            'day' => isset($value['일']) ? trim($value['일']) : '',
                            'serialNumber' => isset($value['일련번호']) ? trim($value['일련번호']) : '',
                            'exclusiveArea' => isset($value['전용면적']) ? trim($value['전용면적']) : '',
                            'jibun' => isset($value['지번']) ? trim($value['지번']) : '',
                            'regionCode' => isset($value['지역코드']) ? trim($value['지역코드']) : '',
                            'floor' => isset($value['층']) ? trim($value['층']) : '',
                            'unique_code' => '0' . (isset($value['년']) ? trim($value['년']) : '') . (isset($value['월']) ? trim($value['월']) : '') . (isset($value['일']) ? trim($value['일']) : '') . (isset($value['일련번호']) ? trim($value['일련번호']) : '') . (isset($value['층']) ? trim($value['층']) : '') . (isset($value['거래금액']) ? trim($value['거래금액']) : ''),
                        ];

                        // Transactions::create($obj);
                        array_push($originItem, $obj);
                    }
                    foreach (array_chunk($originItem, 1000) as $t) {
                        // Transactions::create($t);
                        Log::info($t);
                        Transactions::upsert($t, 'unique_code');
                    }
                }
            }
        );

        $promise->wait();

        return back()->with('message', '아파트 매매 실거래가를 불러왔습니다.');
    }

    /**
     * 아파트 매매 실거래가 정보 불러오기
     */
    public function getTransactionsRentApt(Request $request)
    {
        // API 연동

        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'region_id' => 'required',
            'year' => 'required',
            'month' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect(route('admin.transactions.list.view'))
                ->withErrors($validator)
                ->withInput()
                ->with('error', '아파트 전월세 실거래가를 불러오기를 실패하였습니다.');
        }

        $newLastUpdatedAt = $request->year . str_pad($request->month, 2, '0', STR_PAD_LEFT);

        $region = TransactionsRegionUpdate::select()->where('type', '1')->where('id', $request->region_id)->first();

        if (strtotime($newLastUpdatedAt) > strtotime($region->last_updated_at)) {
            $region->update([
                'last_updated_at' => $newLastUpdatedAt,
            ]);
        }

        $url = "http://openapi.molit.go.kr:8081/OpenAPI_ToolInstallPackage/service/rest/RTMSOBJSvc/getRTMSDataSvcAptRent";

        $param = [
            'serviceKey' => 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==',
            'numOfRows' => '20000',
            // 'LAWD_CD' => '11110',
            // 'DEAL_YMD' => '202406',
            'LAWD_CD' => $region->lawd_cd,
            'DEAL_YMD' => $newLastUpdatedAt,
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response|TransferException $response) {
                $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $jsonDecode = json_decode($json, true);
                $header = $jsonDecode['header'];
                $body = $jsonDecode['body'];
                $items = $body['items'];
                $item = $items['item'] ?? [];
                $originItem = [];
                if ($header['resultCode'] == "00") {
                    foreach ($item as $value) {

                        foreach ($value as $key => $val) {
                            if (is_array($val) && empty($val)) {
                                $value[$key] = '';
                            }
                        }

                        $obj = [
                            'type' => '1',
                            'legalDongCityCode' => trim($value['지역코드']) ?? '',
                            'renewalRight' => trim($value['갱신요구권사용']) ?? '',
                            'constructionYear' => trim($value['건축년도']) ?? '',
                            'contract_type' => trim($value['계약구분']) ?? '',
                            'contract_at' => trim($value['계약기간']) ?? '',
                            'year' => trim($value['년']) ?? '',
                            'legalDong' => trim($value['법정동']) ?? '',
                            'transactionPrice' => trim($value['보증금액']) ?? '',
                            'aptName' => trim($value['아파트']) ?? '',
                            'month' => trim($value['월']) ?? '',
                            'transactionMonthPrice' => trim($value['월세금액']) ?? '',
                            'day' => trim($value['일']) ?? '',
                            'exclusiveArea' => trim($value['전용면적']) ?? '',
                            'previousTransactionPrice' => trim($value['종전계약보증금']) ?? '',
                            'previousTransactionMonthPrice' => trim($value['종전계약월세']) ?? '',
                            'jibun' => trim($value['지번']) ?? '',
                            'regionCode' => trim($value['지역코드']) ?? '',
                            'floor' => trim($value['층']) ?? '',
                            'unique_code' => '1' . (trim($value['년']) ?? '') . (trim($value['월']) ?? '') . (trim($value['일']) ?? '') . (trim($value['아파트']) ?? '') . (trim($value['층']) ?? '') . (trim($value['보증금액']) ?? '') . (trim($value['월세금액']) ?? ''),
                        ];

                        // Transactions::create($obj);
                        array_push($originItem, $obj);
                    }
                    foreach (array_chunk($originItem, 1000) as $t) {
                        // Transactions::create($t);
                        Transactions::upsert($t, 'unique_code');
                    }
                }
            }
        );

        $promise->wait();

        return back()->with('message', '아파트 전월세 실거래가를 불러왔습니다.');
    }

    /**
     * 아파트 실거래가 연결
     */
    public function getTransactionsAptConnection()
    {
        $aptList = DataApt::select()->get();

        foreach ($aptList as $index => $apt) {

            // 쉼표로 구분하여 배열로 변환
            $transactionsList = Transactions::
                // 시도+시군구 코드 비교
                where('legalDongCityCode', substr($apt->bjdCode, 0, 5))
                // 읍면동 비교
                ->where('legalDong', $apt->as3)

                // 아파트 단지명 비교
                ->where(function ($query) use ($apt) {
                    $query->where('aptName', 'like', "%{$apt->kaptName}%")
                        ->orWhere(function ($subQuery) use ($apt) {
                            $subQuery->whereRaw('FIND_IN_SET(transactions_apt.aptName, ?)', [$apt->complex_name]);
                        });
                })->update(['is_matching' => 1]);
        }

        return back()->with('message', '아파트 실거래가가 연결되었습니다.');
    }

    /**
     * 아파트 주소를 다시 재정의
     */
    public function getAptAddrss()
    {

        set_time_limit(1200);

        $confmKey = env('CONFM_KEY'); // 검색API 승인키
        $domain = "http://www.juso.go.kr/addrlink/addrLinkApiJsonp.do"; //인터넷망


        $resultList = DataApt::whereNull('pnu')->orWhereIn('pnu', [1, 2])->where('id', 203)->get();

        foreach ($resultList as $apt) {

            // 아파트와 타운이라는 단어를 모두 제거
            $aptNameWithoutAptAndTown = preg_replace('/(아파트|타운).*/', '', $apt->kaptName);


            // 키워드 구성
            $keyword = '';

            if ($apt->pnu == 1 || $apt->pnu == 3) {
                // 주소에서 아파트명을 지우고 지번주소로 검색
                $cleanedAddr = preg_replace('/' . preg_quote($apt->kaptName, '/') . '.*$/', '', $apt->kaptAddr);
                $keyword = $cleanedAddr;
            } else if ($apt->pnu == 2 || $apt->pnu == 4) {
                // pnu가 2일 경우 주소 검색시에 주소가 2개이상이라서 (디테일하게 검색)

                // pnu가 1일 경우 주소 검색시에 검색된게 없어서 (포괄적으로 검색)
                $keyword = $apt->doroJuso ?? $apt->kaptAddr;
            } else {
                // pnu가 Null일 경우
                // 리이름 또는 동이름과 아파트명칭을 조합
                $keyword = ($apt->as4 ?? $apt->as3) . $aptNameWithoutAptAndTown;
            }

            $data = [
                'resultType' => 'json',
                'currentPage' => '1',
                'countPerPage' => '2',
                'confmKey' => $confmKey,
                'keyword' => $keyword,
                // 'keyword' => '구로동',
                // 'rtentX' => '129.3524326',
                // 'rtentY' => '35.5544986',
            ];

            try {
                // API 호출
                $response = Http::timeout(30)->asForm()->post($domain, $data);

                if ($response->successful()) {
                    // API 응답을 문자열로 받음
                    $responseData = $response->body();

                    // JSONP 형식을 제거하고 JSON 형식으로 변환
                    $jsonData = trim($responseData, '();');

                    // JSON 데이터를 배열로 변환
                    $responseArray = json_decode($jsonData, true);

                    // juso 배열 추출
                    $juso = $responseArray['results']['juso'];

                    // juso 데이터 로그에 기록
                    Log::info($juso);

                    if (!empty($juso)) {
                        // juso 데이터가 2개 이상인지 확인

                        if (count($juso) >= 2 && $juso[0]['jibunAddr'] != $juso[1]['jibunAddr']) {
                            Log::info("There are 2 or more results.");
                            if ($apt->pnu == 1) {
                                $apt->update([
                                    'pnu' => 4,
                                ]);
                            } else {
                                $apt->update([
                                    'pnu' => 2,
                                ]);
                            }
                        } else {
                            Log::info("There are less than 2 results.");
                            // 필요한 데이터 추출 (예: admCd를 pnu로 사용한다고 가정)
                            $AdmCd = (string)$juso[0]['admCd'];
                            $MtYn = $juso[0]['mtYn'] == '0' ? '1' : '2';
                            $LnbrMnnm = str_pad((string)$juso[0]['lnbrMnnm'], 4, '0', STR_PAD_LEFT);
                            $LnbrSlno = str_pad((string)$juso[0]['lnbrSlno'], 4, '0', STR_PAD_LEFT);

                            $pnu = $AdmCd . $MtYn . $LnbrMnnm . $LnbrSlno;

                            // 데이터베이스 업데이트
                            $apt->update([
                                'pnu' => $pnu,
                            ]);

                            // 업데이트 결과 로그에 기록
                            Log::info("DataApt table updated with pnu: " . $pnu);
                        }
                    } else {
                        Log::info("No juso data found.");
                        if ($apt->pnu == 1 || $apt->pnu == 2) {
                            $apt->update([
                                'pnu' => 3,
                            ]);
                        } else {
                            $apt->update([
                                'pnu' => 1,
                            ]);
                        }
                    }
                } else {
                    return Log::error('API request failed: ' . $response->status());
                }
            } catch (\Exception $e) {
                return Log::error('Error occurred: ' . $e->getMessage());
            }
        }
        $pnuCheck = DataApt::whereNull('pnu')->orWhereIn('pnu', [1, 2])->limit(10000)->get();
        if (count($pnuCheck) > 0) {
            $this->getAptAddrss();
        }
    }

    /**
     * 아파트 폴리곤 가져오기
     */
    public function getAptPolygon()
    {

        set_time_limit(1200);

        $key = env('V_WORD_KEY'); // 검색API 승인키
        $domain = env('APP_URL'); // 서버 도메인

        $Apidomain = "http://api.vworld.kr/ned/wfs/getCtnlgsSpceWFS"; //인터넷망

        $AptList = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')->whereNull('polygon_coordinates')->limit(100000)->get();

        foreach ($AptList as $apt) {

            $data = [
                'currentPage' => '1',
                'countPerPage' => '2',
                'key' => $key,
                'domain' => $domain,
                'typename' => 'dt_d002',
                'pnu' => $apt->pnu,
                'maxFeatures' => '10',
                'resultType' => 'result',
                'srsName' => 'EPSG:4326',
            ];


            try {
                // API 호출
                $response = Http::timeout(30)->asForm()->post($Apidomain, $data);

                if ($response->successful()) {
                    // API 응답을 문자열로 받음
                    $responseData = $response->body();

                    // XML 데이터를 SimpleXML 객체로 로드
                    $xml = simplexml_load_string($responseData);
                    if ($xml === false) {
                        Log::error('Failed to parse XML');
                        continue;
                    }

                    // 네임스페이스 처리
                    $namespaces = $xml->getNamespaces(true);
                    $xml->registerXPathNamespace('gml', $namespaces['gml']);
                    $xml->registerXPathNamespace('sop', $namespaces['sop']);

                    // MultiPolygon 데이터 추출
                    $coordinatesElement = $xml->xpath('//gml:MultiPolygon/gml:polygonMember/gml:Polygon/gml:outerBoundaryIs/gml:LinearRing/gml:coordinates')[0];
                    if ($coordinatesElement) {
                        $coordsString = (string)$coordinatesElement;
                        $coordsArray = explode(' ', $coordsString);

                        $convertedCoords = array_map(function ($coord) {
                            $point = explode(',', $coord);
                            return '[' . floatval($point[0]) . ', ' . floatval($point[1]) . ']';
                        }, $coordsArray);

                        $convertedCoordsArray = implode(', ', $convertedCoords);

                        $apt->update([
                            'polygon_coordinates' => $convertedCoordsArray,
                        ]);
                    } else {
                        Log::error('Coordinates not found');
                    }
                } else {
                    return Log::error('API request failed: ' . $response->status());
                }
            } catch (\Exception $e) {
                return Log::error('Error occurred: ' . $e->getMessage());
            }
        }

        return back()->with('message', '아파트 폴리곤을 가져왔습니다.');
    }

    /**
     * 아파트 토지특성 속성 가져오기
     */
    public function getAptCharacteristics()
    {

        set_time_limit(1200);

        $key = env('V_WORD_KEY'); // 검색API 승인키
        $domain = env('APP_URL'); // 서버 도메인

        $Apidomain = "https://api.vworld.kr/ned/data/getLandCharacteristics"; //인터넷망

        $AptList = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')->where('as3', 'like', "%구로동%")->limit(100)->get();

        foreach ($AptList as $apt) {
            Log::info('apt : ' . $apt);

            $data = [
                'pageNo' => '1',
                'numOfRows' => '100',
                'key' => $key,
                'domain' => $domain,
                'pnu' => $apt->pnu,
                'format' => 'json',
                'stdrYear' => '',
            ];

            $response = Http::timeout(30)->asForm()->post($Apidomain, $data);

            usleep(1000000); // 1초 지연 (1000000 마이크로초)

            if ($response->successful()) {

                if ($response === false) {
                    Log::error('응답 본문을 가져오지 못했습니다.');
                } else {
                    $response = json_decode($response->body(), true); // JSON 문자열을 배열로 디코드

                    $fields = $response['landCharacteristicss']['field']; // field 배열 가져오기

                    // 최신 업데이트 날짜를 가진 field를 찾기
                    $latestField = null;
                    $latestDate = null;

                    foreach ($fields as $field) {
                        $currentDate = $field['lastUpdtDt'];
                        if (is_null($latestDate) || strtotime($currentDate) > strtotime($latestDate)) {
                            $latestDate = $currentDate;
                            $latestField = $field;
                        }
                    }

                    if ($latestField) {
                        $apt->update(['characteristics_json' => json_encode($latestField, JSON_UNESCAPED_UNICODE)]);
                    } else {
                        Log::info('field 데이터를 찾을 수 없습니다.');
                    }
                }
            } else {
                Log::error('HTTP 요청 실패:');
            }
        }
        return back()->with('message', '아파트 토지특성 가져왔습니다.');
    }

    /**
     * 아파트 표제부 가져오기
     */
    public function getAptBuildingLedger()
    {
        set_time_limit(1200);

        // $get_types = ['BrTitleInfo', 'BrRecapTitleInfo', 'BrFlrOulnInfo', 'BrExposInfo', 'BrExposPubuseAreaInfo'];

        $AptList = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')->limit(20000)->get();


        Log::info("아파트 정보 초기 : " . $AptList);

        if (count($AptList) > 0) {
            foreach ($AptList as $index => $apt) {

                $pnu = $apt->pnu;
                // 건축물 대장 가져오는 api
                $sigunguCd = substr($pnu, 0, 5);
                $bjdongCd = substr($pnu, 5, 5);
                $platGbCd = substr($pnu, 10, 1) - 1;
                $bun = substr($pnu, 11, 4);
                $ji = substr($pnu, 15, 5);

                $get_types = [];
                // 필요한 타입만 요청 리스트에 추가
                if (count($apt->BrTitleInfo) == 0) {
                    $get_types[] = 'BrTitleInfo';
                }
                if (count($apt->BrRecapTitleInfo) == 0) {
                    $get_types[] = 'BrRecapTitleInfo';
                }
                if (count($apt->BrFlrOulnInfo) == 0) {
                    $get_types[] = 'BrFlrOulnInfo';
                }
                if (count($apt->BrExposInfo) == 0) {
                    $get_types[] = 'BrExposInfo';
                }
                if (count($apt->BrExposPubuseAreaInfo) == 0) {
                    $get_types[] = 'BrExposPubuseAreaInfo';
                }

                if (count($get_types) > 0) {
                    foreach ($get_types as $type) {

                        $url = 'http://apis.data.go.kr/1613000/BldRgstService_v2/get' . $type;

                        $data = [
                            'serviceKey' => env('ENCODING_API_DATE_KEY'), // 서비스 키가 URL 인코딩된 상태로 설정되어 있는지 확인
                            'sigunguCd' => $sigunguCd,
                            'bjdongCd' => $bjdongCd,
                            'platGbCd' => $platGbCd,
                            'bun' => $bun,
                            'ji' => $ji,
                            'numOfRows' => '1000',
                            'pageNo' => '1',
                        ];

                        try {
                            usleep(1000000); // 1초 지연 (1000000 마이크로초)

                            $response = Http::timeout(30)->get($url, $data);

                            if ($response->failed()) {
                                throw new \Exception('HTTP request failed with status ' . $response->status());
                            }

                            Log::info('API Response: ' . $response->body());


                            $xml = simplexml_load_string($response->body());

                            $json = json_encode($xml, JSON_UNESCAPED_UNICODE); // 데이터 인코딩 처리
                            $responseArray = json_decode($json, true);

                            Log::info($type . 'Parsed Response Array: ' . print_r($responseArray, true));

                            $totalCount = $responseArray['body']['totalCount'];
                            // 기존 데이터 업데이트 및 새로운 데이터 삽입
                            if ($totalCount > 0) {

                                if ($totalCount > 1) {
                                    $items = $responseArray['body']['items']['item'];
                                } else {
                                    $items = [$responseArray['body']['items']['item']];
                                }

                                switch ($type) {
                                    case 'BrTitleInfo':
                                        BrTitleInfo::where('target_id', '=', $apt->id)
                                            ->where('target_type', '=', DataApt::class)->update([
                                                'target_type' => null,
                                                'target_id' => null,
                                            ]);
                                        foreach ($items as $item) {
                                            BrTitleInfo::create([
                                                'json_data' => json_encode($item, JSON_UNESCAPED_UNICODE),
                                                'target_type' => DataApt::class,
                                                'target_id' => $apt->id,
                                            ]);
                                        }
                                        break;

                                    case 'BrRecapTitleInfo':
                                        BrRecapTitleInfo::where('target_id', '=', $apt->id)
                                            ->where('target_type', '=', DataApt::class)->update([
                                                'target_type' => null,
                                                'target_id' => null,
                                            ]);
                                        foreach ($items as $item) {
                                            BrRecapTitleInfo::create([
                                                'json_data' => json_encode($item, JSON_UNESCAPED_UNICODE),
                                                'target_type' => DataApt::class,
                                                'target_id' => $apt->id,
                                            ]);
                                        }
                                        break;

                                    case 'BrFlrOulnInfo':
                                        BrFlrOulnInfo::where('target_id', '=', $apt->id)
                                            ->where('target_type', '=', DataApt::class)->update([
                                                'target_type' => null,
                                                'target_id' => null,
                                            ]);
                                        foreach ($items as $item) {
                                            BrFlrOulnInfo::create([
                                                'json_data' => json_encode($item, JSON_UNESCAPED_UNICODE),
                                                'target_type' => DataApt::class,
                                                'target_id' => $apt->id,
                                            ]);
                                        }
                                        break;

                                    case 'BrExposInfo':
                                        BrExposInfo::where('target_id', '=', $apt->id)
                                            ->where('target_type', '=', DataApt::class)->update([
                                                'target_type' => null,
                                                'target_id' => null,
                                            ]);
                                        foreach ($items as $item) {
                                            BrExposInfo::create([
                                                'json_data' => json_encode($item, JSON_UNESCAPED_UNICODE),
                                                'target_type' => DataApt::class,
                                                'target_id' => $apt->id,
                                            ]);
                                        }
                                        break;

                                    case 'BrExposPubuseAreaInfo':
                                        BrExposPubuseAreaInfo::where('target_id', '=', $apt->id)
                                            ->where('target_type', '=', DataApt::class)->update([
                                                'target_type' => null,
                                                'target_id' => null,
                                            ]);
                                        foreach ($items as $item) {
                                            BrExposPubuseAreaInfo::create([
                                                'json_data' => json_encode($item, JSON_UNESCAPED_UNICODE),
                                                'target_type' => DataApt::class,
                                                'target_id' => $apt->id,
                                            ]);
                                        }
                                        break;
                                }
                            }
                        } catch (\Exception $e) {
                            // 오류 처리
                            return Log::error('API 요청 중 오류 발생: ' . $e->getMessage());
                        }
                    }
                }
            }
        }
    }


    public function exportRegionCoordinateUpdateExcel(Request $request): RedirectResponse
    {
        $file = $request->file('excel_file');

        if ($file) {
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            Log::info("업로드된 파일 이름: $fileName, 파일 크기: $fileSize bytes");
        }

        // Excel 파일을 PhpSpreadsheet 라이브러리를 사용하여 읽기
        $spreadsheet = IOFactory::load($file);

        // 모든 시트를 반복
        foreach ($spreadsheet->getSheetNames() as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);

            // 첫 번째 행은 헤더로 간주하여 건너뛰기
            $rowIterator = $sheet->getRowIterator();
            $rowIterator->next();

            $startReading = false; // 두 번째 행부터 데이터를 읽기 위한 플래그

            // 각 행을 반복하여 로그에 출력
            foreach ($rowIterator as $row) {
                if ($startReading) {
                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $rowData[] = $cell->getValue();
                    }
                    // 배열에서 각 열의 데이터를 추출
                    $sido = $rowData[0];
                    $sigungu = $rowData[1];
                    $dong = $rowData[2];
                    $ri = $rowData[3];
                    $address_lat = $rowData[4];
                    $address_lng = $rowData[5];

                    // 데이터베이스 업데이트
                    RegionCoordinate::create([
                        'sido' => $sido,
                        'sigungu' => $sigungu,
                        'dong' => $ri != '' ? $ri : $dong,
                        'address_lat' => $address_lat,
                        'address_lng' => $address_lng,
                    ]);
                } else {
                    $startReading = true;
                }
            }
        }

        return back()->with('message', '엑셀 업로드 완료');
    }
}

<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'numOfRows' => '20000'
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
                        'as1' => isset($value['as1']) ? $value['as1'] : '',
                        'as2' => isset($value['as2']) ? $value['as2'] : '',
                        'as3' => isset($value['as3']) ? $value['as3'] : '',
                        'as4' => isset($value['as4']) ? $value['as4'] : '',
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

        $this->getAptBaseInfo();
        $this->getAptDetailInfo();
        $this->getAptMapInfo();

        return Redirect::route('admin.apt.complex.list.view')->with('아파트 단지를 불러왔습니다.');
    }

    public function getAptBaseInfo()
    {
        $baseInfo = DataApt::where('is_base_info', 0)->limit(10000)->get();

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

        $allDetailInfo = DataApt::where('is_detail_info', 0)->limit(10000)->get();

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

        $mapInfo = DataApt::where('is_map_info', 0)->limit(10000)->get();
        if ($mapInfo == null) {
            return;
        }

        foreach ($mapInfo as $map) {
            $address = $map->doroJuso == null ? implode(' ', array_slice(explode(' ', $map->kaptAddr), 2)) : $map->doroJuso;

            $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode";
            $param = [
                'query' => $address
            ];

            $promise = Http::withHeaders([
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
            $promise->wait();
        }
    }


    /**
     * 아파트 매매 실거래가 정보 불러오기
     */
    public function getTranscationsApt(Request $request)
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
                $item = $items['item'];
                $originItem = [];
                if ($header['resultCode'] == "00") {
                    foreach ($item as $value) {

                        $obj = [
                            'type' => '0',
                            'transactionPrice' => isset($value['거래금액']) ? $value['거래금액'] : '',
                            'constructionYear' => isset($value['건축년도']) ? $value['건축년도'] : '',
                            'year' => isset($value['년']) ? $value['년'] : '',
                            'roadName' => isset($value['도로명']) ? $value['도로명'] : '',
                            'roadBuildingMainCode' => isset($value['도로명건물본번호코드']) ? $value['도로명건물본번호코드'] : '',
                            'roadBuildingSubCode' => isset($value['도로명건물부번호코드']) ? $value['도로명건물부번호코드'] : '',
                            'roadCityCode' => isset($value['도로명시군구코드']) ? $value['도로명시군구코드'] : '',
                            'roadSerialCode' => isset($value['도로명일련번호코드']) ? $value['도로명일련번호코드'] : '',
                            'roadUpDownCode' => isset($value['도로명지상지하코드']) ? $value['도로명지상지하코드'] : '',
                            'roadCode' => isset($value['도로명코드']) ? $value['도로명코드'] : '',
                            'legalDong' => isset($value['법정동']) ? $value['법정동'] : '',
                            'legalDongMainNumberCode' => isset($value['법정동본번코드']) ? $value['법정동본번코드'] : '',
                            'legalDongSubNumberCode' => isset($value['법정동부번코드']) ? $value['법정동부번코드'] : '',
                            'legalDongCityCode' => isset($value['법정동시군구코드']) ? $value['법정동시군구코드'] : '',
                            'legalDongDistrictCode' => isset($value['법정동읍면동코드']) ? $value['법정동읍면동코드'] : '',
                            'legalDongCode' => isset($value['법정동지번코드']) ? $value['법정동지번코드'] : '',
                            'aptName' => isset($value['아파트']) ? $value['아파트'] : '',
                            'month' => isset($value['월']) ? $value['월'] : '',
                            'day' => isset($value['일']) ? $value['일'] : '',
                            'serialNumber' => isset($value['일련번호']) ? $value['일련번호'] : '',
                            'exclusiveArea' => isset($value['전용면적']) ? $value['전용면적'] : '',
                            'jibun' => isset($value['지번']) ? $value['지번'] : '',
                            'regionCode' => isset($value['지역코드']) ? $value['지역코드'] : '',
                            'floor' => isset($value['층']) ? $value['층'] : '',
                            'unique_code' => (isset($value['년']) ? $value['년'] : '') . (isset($value['월']) ? $value['월'] : '') . (isset($value['일']) ? $value['일'] : '') . (isset($value['일련번호']) ? $value['일련번호'] : '') . (isset($value['층']) ? $value['층'] : '') . (isset($value['거래금액']) ? $value['거래금액'] : ''),
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

        return back()->with('message', '아파트 매매 실거래가를 불러왔습니다.');
    }

    /**
     * 아파트 매매 실거래가 정보 불러오기
     */
    public function getTranscationsRentApt(Request $request)
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

        $region = TransactionsRegionUpdate::select()->where('type', '0')->where('id', $request->region_id)->first();

        if (strtotime($newLastUpdatedAt) > strtotime($region->last_updated_at)) {
            $region->update([
                'last_updated_at' => $newLastUpdatedAt,
            ]);
        }

        $url = "http://openapi.molit.go.kr:8081/OpenAPI_ToolInstallPackage/service/rest/RTMSOBJSvc/getRTMSDataSvcAptRent";

        $param = [
            'serviceKey' => 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==',
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
                $item = $items['item'];
                $originItem = [];
                if ($header['resultCode'] == "00") {
                    foreach ($item as $value) {

                        $obj = [
                            'type' => '0',
                            'transactionPrice' => isset($value['거래금액']) ? $value['거래금액'] : '',
                            'constructionYear' => isset($value['건축년도']) ? $value['건축년도'] : '',
                            'year' => isset($value['년']) ? $value['년'] : '',
                            'roadName' => isset($value['도로명']) ? $value['도로명'] : '',
                            'roadBuildingMainCode' => isset($value['도로명건물본번호코드']) ? $value['도로명건물본번호코드'] : '',
                            'roadBuildingSubCode' => isset($value['도로명건물부번호코드']) ? $value['도로명건물부번호코드'] : '',
                            'roadCityCode' => isset($value['도로명시군구코드']) ? $value['도로명시군구코드'] : '',
                            'roadSerialCode' => isset($value['도로명일련번호코드']) ? $value['도로명일련번호코드'] : '',
                            'roadUpDownCode' => isset($value['도로명지상지하코드']) ? $value['도로명지상지하코드'] : '',
                            'roadCode' => isset($value['도로명코드']) ? $value['도로명코드'] : '',
                            'legalDong' => isset($value['법정동']) ? $value['법정동'] : '',
                            'legalDongMainNumberCode' => isset($value['법정동본번코드']) ? $value['법정동본번코드'] : '',
                            'legalDongSubNumberCode' => isset($value['법정동부번코드']) ? $value['법정동부번코드'] : '',
                            'legalDongCityCode' => isset($value['법정동시군구코드']) ? $value['법정동시군구코드'] : '',
                            'legalDongDistrictCode' => isset($value['법정동읍면동코드']) ? $value['법정동읍면동코드'] : '',
                            'legalDongCode' => isset($value['법정동지번코드']) ? $value['법정동지번코드'] : '',
                            'aptName' => isset($value['아파트']) ? $value['아파트'] : '',
                            'month' => isset($value['월']) ? $value['월'] : '',
                            'day' => isset($value['일']) ? $value['일'] : '',
                            'serialNumber' => isset($value['일련번호']) ? $value['일련번호'] : '',
                            'exclusiveArea' => isset($value['전용면적']) ? $value['전용면적'] : '',
                            'jibun' => isset($value['지번']) ? $value['지번'] : '',
                            'regionCode' => isset($value['지역코드']) ? $value['지역코드'] : '',
                            'floor' => isset($value['층']) ? $value['층'] : '',
                            'unique_code' => (isset($value['년']) ? $value['년'] : '') . (isset($value['월']) ? $value['월'] : '') . (isset($value['일']) ? $value['일'] : '') . (isset($value['일련번호']) ? $value['일련번호'] : '') . (isset($value['층']) ? $value['층'] : '') . (isset($value['거래금액']) ? $value['거래금액'] : ''),
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
}

<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Client\ConnectionException;

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
        // $this->getAptDetailInfo();
        // $this->getAptMapInfo();

        return Redirect::route('admin.apt.complex.list.view')->with('아파트 단지를 불러왔습니다.');
    }
    public function getAptBaseInfo()
    {
        $baseInfo = DataApt::where('is_base_info', 0)->get();

        // 베이스 정보가 없을 때
        if ($baseInfo == null) {
            return;
        }

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusBassInfo";
        $serviceKey = 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==';

        $batchSize = 10; // 한 번에 처리할 배치 크기
        $delay = 2; // 각 배치 사이의 딜레이 (초)

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
                            Log::error('Exception: ' . $e->getMessage());
                        }
                    },
                    function ($exception) use ($base) {
                        if ($exception instanceof \GuzzleHttp\Exception\ConnectException) {
                            Log::error('Connection error for kaptCode ' . $base->kaptCode . ': ' . $exception->getMessage());
                        } else {
                            Log::error('HTTP Request failed for kaptCode ' . $base->kaptCode . ': ' . $exception->getMessage());
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
        set_time_limit(300);

        $allDetailInfo = DataApt::where('is_detail_info', 0)->get();

        // 베이스 정보가 없을 때
        if ($allDetailInfo->isEmpty()) {
            return;
        }

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusDtlInfo";
        $serviceKey = 'OOOeb2NMDrvDEatMXUQZ/bLs8pjBm+0c4X5snSQHQ/rWaslq3lhn0rbXISZf7yRCzLU5C0hSKHUnYw8CcFvg5A==';

        $batchSize = 10; // 한 번에 처리할 배치 크기
        $delay = 2; // 각 배치 사이의 딜레이 (초)

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
                                Log::info('$item : ' . json_encode($item));
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
        $mapInfo = DataApt::where('is_map_info', 0)->first();
        if ($mapInfo == null) {
            return;
        }

        $address = $mapInfo->doroJuso == null ? $mapInfo->kaptAddr : $mapInfo->doroJuso;

        $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode";
        $param = [
            'query' => $address
        ];

        $promise = Http::withHeaders([
            'X-NCP-APIGW-API-KEY-ID' => 'iipoiiuz42',
            'X-NCP-APIGW-API-KEY' => '733JkOIwJF6wOkI66OWBe8jDen72TrzP6qbTSkbP',
            'Accept' => 'application/json'
        ])->async()->get($url, $param)->then(
            function (Response|TransferException $response) use ($mapInfo) {
                $jsonDecode = json_decode($response->body(), true);
                $addresses = $jsonDecode['addresses'];
                if (count($addresses) > 0) {
                    $address = $addresses[0];
                    $obj = [
                        'is_map_info' => 1,
                        'x' => $address['x'],
                        'y' => $address['y'],
                    ];
                    $mapInfo->update($obj);
                } else {
                    $address = $addresses[0];
                    $obj = [
                        'is_map_info' => 1,
                    ];
                    $mapInfo->update($obj);
                }
            }
        );
        $promise->wait();
    }
}

<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            'serviceKey' => '58+BxzpkxifZ5RGHKDirbnr5Y3l1iK7+y6WxyiyR6sIp8jwIMXeQDAi8zXNY+kyFHznaAHVFxb33c40XOGqaqg==',
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


                Log::debug("국토교통부 - 아파트 전체 :" . $json);
            }
        );

        $promise->wait();
    }

    // 아파트 기본 정보
    public function getAptBaseInfo()
    {
        $baseInfo = DataApt::where('is_base_info', 0)->first();

        // 베이스 정보가 없을 때
        if ($baseInfo == null) {
            return;
        }


        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusBassInfo";

        $param = [
            'serviceKey' => '58+BxzpkxifZ5RGHKDirbnr5Y3l1iK7+y6WxyiyR6sIp8jwIMXeQDAi8zXNY+kyFHznaAHVFxb33c40XOGqaqg==',
            'kaptCode' => $baseInfo->kaptCode
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response|TransferException $response) use ($baseInfo) {
                $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $jsonDecode = json_decode($json, true);
                $body = $jsonDecode['body'];
                $item = $body['item'];
                $item['is_base_info'] = 1;
                $baseInfo->update($item);
            }
        );

        $promise->wait();
    }

    // 아파트 상세 정보
    public function getAptDetailInfo()
    {
        $detailInfo = DataApt::where('is_detail_info', 0)->first();
        // 베이스 정보가 없을 때
        if ($detailInfo == null) {
            return;
        }

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusDtlInfo";
        $param = [
            'serviceKey' => '58+BxzpkxifZ5RGHKDirbnr5Y3l1iK7+y6WxyiyR6sIp8jwIMXeQDAi8zXNY+kyFHznaAHVFxb33c40XOGqaqg==',
            'kaptCode' => $detailInfo->kaptCode
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response|TransferException $response) use ($detailInfo) {
                $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $jsonDecode = json_decode($json, true);
                $body = $jsonDecode['body'];
                $item = $body['item'];
                $item['is_detail_info'] = 1;
                $detailInfo->update($item);
            }
        );

        $promise->wait();
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
                }
            }
        );
        $promise->wait();
    }
}

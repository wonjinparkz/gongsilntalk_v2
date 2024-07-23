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
use Exception;
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
     * 아파트 단지 불러오기
     */
    public function getApt()
    {
        // API 연동
        $url = "http://apis.data.go.kr/1613000/AptListService2/getTotalAptList";

        $param = [
            'serviceKey' => env('ENCODING_API_DATE_KEY'),
            'numOfRows' => '100000',
            ''
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
        if (is_null($baseInfo)) {
            return;
        }

        Log::info('베이스 정보 아파트 정보 :' . $baseInfo);

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusBassInfo";
        $serviceKey = env('ENCODING_API_DATE_KEY');

        $param = [
            'serviceKey' => $serviceKey,
            'kaptCode' => $baseInfo->kaptCode
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response $response) use ($baseInfo) {
                try {
                    $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $jsonDecode = json_decode($json, true);

                    if (isset($jsonDecode['body']) && isset($jsonDecode['body']['item'])) {
                        $body = $jsonDecode['body'];
                        $item = $body['item'];
                        $item['is_base_info'] = 1;
                        $baseInfo->update($item);
                    } else {
                        Log::error('Invalid response structure: ' . json_encode($jsonDecode));
                    }
                } catch (\Exception $e) {
                    Log::error('Exception: ' . $e->getMessage());
                }
            },
            function (ConnectionException $exception) use ($baseInfo) {
                Log::error('Connection error for kaptCode ' . $baseInfo->kaptCode . ': ' . $exception->getMessage());
            }
        );
        $promise->wait();
    }


    public function getAptDetailInfo()
    {
        $DetailInfo = DataApt::where('is_detail_info', 0)->first();

        if ($DetailInfo == '') {
            return;
        }

        Log::info('상세 정보 아파트 정보 :' . $DetailInfo);

        $url = "http://apis.data.go.kr/1613000/AptBasisInfoService1/getAphusDtlInfo";
        $serviceKey = env('ENCODING_API_DATE_KEY');

        $param = [
            'serviceKey' => $serviceKey,
            'kaptCode' => $DetailInfo->kaptCode
        ];

        $promise = Http::async()->get($url, $param)->then(
            function (Response $response) use ($DetailInfo) {
                try {
                    $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $jsonDecode = json_decode($json, true);

                    if (isset($jsonDecode['body']) && isset($jsonDecode['body']['item'])) {
                        $body = $jsonDecode['body'];
                        $item = $body['item'];
                        $item['is_detail_info'] = 1;
                        $DetailInfo->update($item);
                    } else {
                        Log::error('Invalid response structure: ' . json_encode($jsonDecode));
                    }
                } catch (\Exception $e) {
                    Log::error('Exception: ' . $e->getMessage());
                }
            },
            function (ConnectionException $exception) use ($DetailInfo) {
                Log::error('Connection error for kaptCode ' . $DetailInfo->kaptCode . ': ' . $exception->getMessage());
            }
        );
        $promise->wait();
    }

    // 아파트 지도 정보 위도 경도 - 네이버
    public function getAptMapInfo()
    {

        $mapInfo = DataApt::where('is_map_info', 0)->where('is_detail_info', 1)->first();

        if ($mapInfo == '') {
            return;
        }

        Log::info('좌표 아파트 정보 :' . $mapInfo);

        $address = $mapInfo->doroJuso == null ? implode(' ', array_slice(explode(' ', $mapInfo->kaptAddr), 2)) : $mapInfo->doroJuso;

        $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode";
        $param = [
            'query' => $address
        ];

        $promise = Http::withHeaders([
            'X-NCP-APIGW-API-KEY-ID' => env('VITE_NAVER_MAP_CLIENT_ID'),
            'X-NCP-APIGW-API-KEY' => env('VITE_NAVER_MAP_CLIENT_SECRET'),
            'Accept' => 'application/json'
        ])->async()->get($url, $param)->then(
            function (Response|TransferException $response) use ($mapInfo) {
                if ($response instanceof TransferException) {
                    Log::error('API 호출 중 오류 발생: ' . $response->getMessage());
                    return;
                }

                $jsonDecode = json_decode($response->body(), true);
                $addresses = $jsonDecode['addresses'];

                if (count($addresses) > 0) {
                    $address = $addresses[0];
                    $addressElements = $address['addressElements'];

                    $obj = [
                        'is_map_info' => 1,
                        'kaptAddr' => $address['jibunAddress'],
                        'x' => $address['x'],
                        'y' => $address['y'],
                    ];
                    $mapInfo->update($obj);
                } else {
                    $obj = [
                        'is_map_info' => 1,
                    ];
                    $mapInfo->update($obj);
                }
            }
        );
        $promise->wait();
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
            'serviceKey' => env('ENCODING_API_DATE_KEY'),
            'numOfRows' => '20000',
            'LAWD_CD' => $region->lawd_cd,
            'DEAL_YMD' => $newLastUpdatedAt,
        ];

        Log::info(env('ENCODING_API_DATE_KEY'));

        $promise = Http::async()->get($url, $param)->then(
            function (Response|TransferException $response) {
                try {
                    if ($response instanceof TransferException) {
                        // 예외 처리
                        Log::error('HTTP request failed: ' . $response->getMessage());
                        return;
                    }

                    $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    if ($xml === false) {
                        // XML 파싱 오류 처리
                        Log::error('Failed to parse XML response: ' . $response->getBody());
                        return;
                    }

                    $json = json_encode($xml);
                    $jsonDecode = json_decode($json, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        // JSON 디코딩 오류 처리
                        Log::error('Failed to decode JSON: ' . json_last_error_msg());
                        return;
                    }

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

                            array_push($originItem, $obj);
                        }
                        foreach (array_chunk($originItem, 1000) as $t) {
                            // Transactions::create($t);
                            Log::info('Inserting transactions: ' . json_encode($t));
                            Transactions::upsert($t, 'unique_code');
                        }
                    } else {
                        Log::warning('API response returned with resultCode: ' . $header['resultCode']);
                    }
                } catch (Exception $e) {
                    Log::error('An error occurred: ' . $e->getMessage());
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
            'serviceKey' => env('ENCODING_API_DATE_KEY'),
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
        // $aptList = DataApt::select()->get();

        // foreach ($aptList as $index => $apt) {

        //     // 쉼표로 구분하여 배열로 변환
        //     $transactionsList = Transactions::
        //         // 시도+시군구 코드 비교
        //         where('legalDongCityCode', substr($apt->bjdCode, 0, 5))

        //         // 아파트 단지명 비교
        //         ->where(function ($query) use ($apt) {
        //             $query->where('aptName', 'like', "%{$apt->kaptName}%")
        //                 ->orWhere(function ($subQuery) use ($apt) {
        //                     $subQuery->whereRaw('FIND_IN_SET(transactions_apt.aptName, ?)', [$apt->complex_name]);
        //                 });
        //         })->update(['is_matching' => 1]);
        // }

        $transactionsList = Transactions::where('is_matching', '=', '0')->get();

        foreach ($transactionsList as $index => $transaction) {
            $apt = DataApt::where('bjdCode', 'like', "{$transaction->legalDongCityCode}%")
                ->where(function ($query) use ($transaction) {
                    $query->where('kaptName', 'like', "%{$transaction->aptName}%")
                        ->orWhere(function ($subQuery) use ($transaction) {
                            $subQuery->whereRaw('FIND_IN_SET(?, data_apt.kaptName)', [$transaction->aptName]);
                        });
                })
                ->first();
            if ($apt) {
                Transactions::where('id', $transaction->id)->update(['is_matching' => 1]);
            }
        }

        return back()->with('message', '아파트 실거래가가 연결되었습니다.');
    }

    /**
     * 아파트 주소를 다시 재정의
     */
    public function getAptAddrss()
    {

        $confmKey = env('CONFM_KEY'); // 검색API 승인키
        $domain = "http://www.juso.go.kr/addrlink/addrLinkApiJsonp.do"; //인터넷망

        $apt = DataApt::where('is_pnu', 0)->first();

        if ($apt == '') {
            return;
        }

        // 키워드 구성
        $keyword = $apt->doroJuso == null ? implode(' ', array_slice(explode(' ', $apt->kaptAddr), 2)) : $apt->doroJuso;

        $data = [
            'resultType' => 'json',
            'currentPage' => '1',
            'countPerPage' => '2',
            'confmKey' => $confmKey,
            'keyword' => $keyword,
        ];

        Log::info($data);

        $promise = Http::async()->get($domain, $data)->then(
            function (Response $response) use ($apt, $keyword) {
                try {
                    // API 응답을 문자열로 받음
                    $responseData = $response->body();

                    // JSONP 형식을 제거하고 JSON 형식으로 변환
                    $jsonData = trim($responseData, '();');

                    // JSON 데이터를 배열로 변환
                    $responseArray = json_decode($jsonData, true);

                    // juso 배열 추출
                    $jusoArray = $responseArray['results']['juso'];

                    Log::info($jusoArray);

                    if ($jusoArray != '') {
                        $AdmCd = '';
                        $MtYn = '';
                        $LnbrMnnm = '';
                        $LnbrSlno = '';
                        // 필요한 데이터 추출 (예: admCd를 pnu로 사용한다고 가정)
                        if (count($jusoArray) > 1) {
                            foreach ($jusoArray as $juso)
                                if ($jusoArray[0]['jibunAddr'] == $keyword || $jusoArray[0]['roadAddrPart1'] == $keyword) {
                                    $AdmCd = (string)$jusoArray[0]['admCd'];
                                    $MtYn = $jusoArray[0]['mtYn'] == '0' ? '1' : '2';
                                    $LnbrMnnm = str_pad((string)$jusoArray[0]['lnbrMnnm'], 4, '0', STR_PAD_LEFT);
                                    $LnbrSlno = str_pad((string)$jusoArray[0]['lnbrSlno'], 4, '0', STR_PAD_LEFT);
                                } else {
                                    $AdmCd = (string)$jusoArray[1]['admCd'];
                                    $MtYn = $jusoArray[1]['mtYn'] == '0' ? '1' : '2';
                                    $LnbrMnnm = str_pad((string)$jusoArray[1]['lnbrMnnm'], 4, '0', STR_PAD_LEFT);
                                    $LnbrSlno = str_pad((string)$jusoArray[1]['lnbrSlno'], 4, '0', STR_PAD_LEFT);
                                }
                        }

                        $pnu = $AdmCd . $MtYn . $LnbrMnnm . $LnbrSlno;


                        // 데이터베이스 업데이트
                        $apt->update([
                            'is_pnu' => 1,
                            'pnu' => $pnu,
                        ]);
                    } else {
                        $apt->update([
                            'is_pnu' => 1
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Exception: ' . $e->getMessage());
                }
            },
            function (ConnectionException $exception) use ($apt) {
                Log::error('Connection error for kaptCode ' . $apt->kaptCode . ': ' . $exception->getMessage());
            }
        );
        $promise->wait();
    }

    /**
     * 아파트 폴리곤 가져오기
     */
    public function getAptPolygon()
    {

        $key = env('V_WORD_KEY'); // 검색API 승인
        $domain = env('APP_URL'); // 서버 도메인

        $Apidomain = "http://api.vworld.kr/ned/wfs/getCtnlgsSpceWFS"; //인터넷망

        $apt = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')->where('is_polygon_coordinates', 0)->first();

        if ($apt == '') {
            return;
        }

        $apt->update(['is_polygon_coordinates' => 1]);

        Log::info('폴리곤 아파트 정보 :' . $apt);

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

        // API 호출
        $promise = Http::async()->get($Apidomain, $data)->then(
            function (Response $response) use ($apt) {
                try {

                    if ($response->successful()) {
                        // API 응답을 문자열로 받음
                        $responseData = $response->body();

                        // XML 데이터를 SimpleXML 객체로 로드
                        $xml = simplexml_load_string($responseData);
                        if ($xml === false) {
                            Log::error('Failed to parse XML');
                            return;
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
            },
            function (ConnectionException $exception) use ($apt) {
                Log::error('Connection error for kaptCode ' . $apt->kaptCode . ': ' . $exception->getMessage());
            }
        );
        $promise->wait();
    }

    /**
     * 아파트 토지특성 속성 가져오기
     */
    public function getAptCharacteristics()
    {
        $key = env('V_WORD_KEY'); // 검색API 승인키
        $domain = env('APP_URL'); // 서버 도메인

        $Apidomain = "https://api.vworld.kr/ned/data/getLandCharacteristics"; //인터넷망

        $apt = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')->where('is_characteristics', 0)->first();

        if ($apt == '') {
            return;
        }

        $apt->update(['is_characteristics' => 1]);

        Log::info('토지특성 아파트 정보 :' . $apt);

        $data = [
            'pageNo' => '1',
            'numOfRows' => '100',
            'key' => $key,
            'domain' => $domain,
            'pnu' => $apt->pnu,
            'format' => 'json',
            'stdrYear' => '',
        ];

        $promise = Http::async()->get($Apidomain, $data)->then(
            function (Response $response) use ($apt) {

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
            },
            function (ConnectionException $exception) use ($apt) {
                Log::error('Connection error for kaptCode ' . $apt->kaptCode . ': ' . $exception->getMessage());
            }
        );
        $promise->wait();
    }

    /**
     * 아파트 WFS 속성 가져오기
     */
    public function getAptuseWFS()
    {
        $key = env('V_WORD_KEY'); // 검색API 승인키
        $domain = env('APP_URL'); // 서버 도메인

        $Apidomain = "https://api.vworld.kr/ned/wfs/getLandUseWFS"; //인터넷망

        $apt = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')->where('is_useWFS', 0)->first();

        if ($apt == null) {
            return;
        }

        Log::info('WFS 아파트 정보 :' . $apt);

        $apt->update(['is_useWFS' => 1]);

        $data = [
            'maxFeatures' => '10',
            'typename' => 'dt_d154',
            'key' => $key,
            'domain' => $domain,
            'bbox' => '',
            'pnu' => $apt->pnu,
            'resultType' => 'results',
            'srsName' => 'EPSG:4326',
            'output' => 'text/javascript',
        ];

        $promise = Http::async()->get($Apidomain, $data)->then(
            function ($response) use ($apt) {
                $responseBody = $response->body();
                // JSON 데이터를 디코드합니다.

                // parseResponse 부분 제거
                $jsonString = preg_replace('/^parseResponse\((.*)\)$/', '$1', $responseBody);

                $data = json_decode($jsonString, true);

                if (isset($data['features'][0]['properties'])) {
                    $apt->update(['useWFS_json' => json_encode($data['features'][0]['properties'], JSON_UNESCAPED_UNICODE)]);
                } else {
                    Log::info('field 데이터를 찾을 수 없습니다.');
                }
            },
            function ($exception) use ($apt) {
                Log::error('Connection error for pnu ' . $apt->pnu . ': ' . $exception->getMessage());
            }
        );

        $promise->wait();
    }

    /**
     * 아파트 표제부 가져오기
     */
    public function getAptBuildingLedger()
    {

        $apt = DataApt::whereRaw('CHAR_LENGTH(pnu) = 19')
            ->where(function ($query) {
                $query->whereDoesntHave('BrTitleInfo')
                    ->orWhereDoesntHave('BrRecapTitleInfo')
                    ->orWhereDoesntHave('BrFlrOulnInfo')
                    ->orWhereDoesntHave('BrExposInfo')
                    ->orWhereDoesntHave('BrExposPubuseAreaInfo');
            })
            ->first();

        if ($apt == '') {
            return;
        }

        Log::info('표제부 아파트 정보 : ' . $apt);

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

                $promises[] = Http::async()->get($url, $data)->then(
                    function (Response $response) use ($apt, $type) {

                        $apt->update(['is_building_ledger' => 1]);

                        try {
                            $xml = simplexml_load_string($response->body());

                            $json = json_encode($xml, JSON_UNESCAPED_UNICODE); // 데이터 인코딩 처리
                            $responseArray = json_decode($json, true);

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
                    },
                    function (ConnectionException $exception) use ($apt) {
                        Log::error('Connection error for kaptCode ' . $apt->kaptCode . ': ' . $exception->getMessage());
                    }
                );
                foreach ($promises as $promise) {
                    $promise->wait();
                }
            }
        }
    }



    // 엑셀 행정구역 중심 좌표
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
                        'dong' => $ri == '' ? $ri : $dong,
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

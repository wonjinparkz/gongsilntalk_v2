<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use App\Models\DataApt;
use App\Models\RegionCoordinate;
use App\Models\Subway;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PopupOpenController extends Controller
{

    /**
     * 주소 팝업
     */
    public function getAddress(): View
    {
        return view('address.jusoPopup');
    }

    /**
     * 주소 리다이렉트
     */
    public function getAddressRedirect(Request $request): View
    {
        $result = $request;
        return view('address.jusoPopupRedirect', compact('result'));
    }

    /**
     *  주소 검색
     */
    public function searchAddress(Request $request)
    {
        $subwayList = Subway::where('subway_name', 'like', "%{$request->search}%")->limit(10)->get();

        $regionList = RegionCoordinate::where('dong', 'like', "%{$request->search}%")->limit(10)->get();

        $productList = DataApt::where('kaptName', 'like', "%{$request->search}%")->limit(10)->get();

        $responseData = [
            'subwayList' => $subwayList,
            'regionList' => $regionList,
            'productList' => $productList
        ];

        return $this->sendResponse($responseData, "주소 검색 결과값.");
    }

    // 아파트 지도 정보 위도 경도 - 네이버
    public function getSearcgAddressInfo(Request $request)
    {
        $address = $request->input('address', '');

        if (empty($address)) {
            return response()->json(['error' => '주소가 제공되지 않았습니다.'], 400);
        }

        $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode";
        $param = ['query' => $address];

        $response = Http::withHeaders([
            'X-NCP-APIGW-API-KEY-ID' => env('VITE_NAVER_MAP_CLIENT_ID'),
            'X-NCP-APIGW-API-KEY' => env('VITE_NAVER_MAP_CLIENT_SECRET'),
            'Accept' => 'application/json'
        ])->get($url, $param);  // 동기 요청으로 변경

        if ($response->successful()) {
            $jsonDecode = json_decode($response->body(), true);
            if (!empty($jsonDecode['addresses']) && is_array($jsonDecode['addresses']) && count($jsonDecode['addresses']) > 0) {
                $addresses = $jsonDecode['addresses'];
                $addressInfo = $addresses[0];

                $results = [
                    'roadAddress' => $addressInfo['roadAddress'] ?? '',
                    'jibunAddress' => $addressInfo['roadAddress'] ?? '',
                    'latitude' => $addressInfo['y'],
                    'longitude' => $addressInfo['x']
                ];

                return response()->json(['AddressList' => $results, 'message' => '주소 검색 결과값']);
            } else {
                // 검색된 주소가 없을 경우
                return response()->json(['error' => '검색된 주소가 없습니다.'], 404);
            }
        } else {
            Log::error('API 호출 중 오류 발생: ' . $response->body());
            return response()->json(['error' => 'API 호출 실패'], $response->status());
        }
    }
}

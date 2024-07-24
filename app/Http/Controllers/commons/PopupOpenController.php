<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use App\Models\RegionCoordinate;
use App\Models\Subway;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
        Log::info($request);
        $result = $request;
        return view('address.jusoPopupRedirect', compact('result'));
    }

    /**
     *  주소 검색
     */
    public function searchAddress(Request $request)
    {
        $subwayList = Subway::where('subway_name', 'like', "%{$request->search}%")->get();

        $regionList = RegionCoordinate::where('dong', 'like', "%{$request->search}%")->get();

        $responseData = [
            'subwayList' => $subwayList,
            'regionList' => $regionList
        ];

        return $this->sendResponse($responseData, "주소 검색 결과값.");
    }
}

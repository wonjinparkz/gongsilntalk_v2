<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
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


        // return $this->sendResponse($result, "주소 검색 결과값.");
    }
}

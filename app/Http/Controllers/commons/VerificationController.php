<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 본인인증
|--------------------------------------------------------------------------
|
| - 본인인증 호출
| - 본인인증 결과 받기
|
*/

class VerificationController extends Controller
{
    /**
     * 본인인증 시작 화면
     */
    public function verificationStart(Request $request): View
    {
        return view('commons.verification-start');
    }

    /**
     * 본인인증 결과 페이지
     */
    public function verificationResult(Request $request): View
    {
        $imp_uid = $request->imp_uid;
        $merchant_uid = $request->merchant_uid;
        $success = $request->success;

        Log::info($request);

        if ($success == 'false') {
            return view('commons.verification-error');
        }

        // 인증 토큰 발급 받기
        $tokenResponse = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->post('https://api.iamport.kr/users/getToken', [
            'imp_key' => env('IMP_KEY'),
            'imp_secret' => env('IMP_SECRET'),
        ]);

        $accessToken = null;
        if ($tokenResponse->successful()) {
            $tokenjson = json_decode($tokenResponse->body());
            $accessToken = $tokenjson->response->access_token;
        } else {
            Log::error('인증 토큰 발급 오류 1 = ' . $tokenResponse->body());
            return view('commons.verification-error');
        }

        // 결과 조회
        $response = Http::withHeaders([
            "Authorization" => $accessToken
        ])->get("https://api.iamport.kr/certifications/" . $imp_uid);

        $result = null;
        if ($response->successful()) {
            $resultJson = json_decode($response->body());
            // Log::debug("result = " . json_encode($resultJson));
            $result = [
                "name" => $resultJson->response->name,
                "gender" => $resultJson->response->gender,
                "birth" => $resultJson->response->birthday,
                "phone" => $resultJson->response->phone,
                "unique_key" => $resultJson->response->unique_key,
                "unique_in_site" => $resultJson->response->unique_in_site
            ];
            return view('commons.verification-result', compact('result'));
        } else {
            Log::error('인증 토큰 발급 오류 2 = ' . $response->body());
            return view('commons.verification-error');
        }
    }
}

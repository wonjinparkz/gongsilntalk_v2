<?php

namespace App\Http\Controllers\alarm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;

/*
|--------------------------------------------------------------------------
| 알림 관리자
|--------------------------------------------------------------------------
|
| - 알림 발송 보기
| - 알림 발송
| - 알림톡 발송
*/

class AlaramController extends Controller
{
    /**
     * 알림 발송 보기
     */
    public function view(): View
    {
        return view('admin.alarm.alarm-list');
    }

    /**
     * 알림 발송
     */
    public function send(Request $request): RedirectResponse
    {
        $userList = User::select(
            'fcm_key'
        )->get();

        $fcmKeys = array();

        // TODO: DB 조회로 변경 필요.
        foreach ($userList as $value) {
            array_push($fcmKeys, $value->fcm_key);
        }

        // array_push($fcmKeys, "eJQ-Sb72RwiMbAcLiLbwNp:APA91bEoDHooLmANQcbOWKHdnWLvP0Edq0zTogRJhOav4rCO6SoOwkeqXORf3QJDKi3dINBsKZbO86IMFQp24U1XatpvOA-NxbQ3OTtaqq9kBiD0IW2jBhLJM9pBYktm_18hGOAUaIZ0");
        // array_push($fcmKeys, "exTjHPlBIUMkoCqIdAOcy-:APA91bEUvH0pDh_mTh8n2-jCFNgPpWCoYX7s9d7cSi61JNRRjl5nWe-RjfZG-b-kCYwWd9vx2I_tJdQK5UnI5R1B7nMzAMxfdZsPj-PhpuTDzxqW6obMGZhFnimtU-B-f7ESiqp1zvYg");

        $messaging =  app('firebase.messaging');
        $message = CloudMessage::fromArray([
            // 'notification' => ['title'=>"앱이름", 'body'=>$request->message.'notification'],
            'data' => ['title' => "앱이름", 'body' => $request->message . 'data', 'index' => '1010'],
            'badge' => 1
        ]);

        if (count($fcmKeys) > 0) {
            $response = $messaging->sendMulticast($message, $fcmKeys);

            // 오류 체크
            $validTokens = count($response->validTokens());
            $unknownTokens = count($response->unknownTokens());
            $invalidTokens = count($response->invalidTokens());

            return Redirect::route('admin.alarm.view')->with('message', '알림을 발송했습니다.');
        } else {
            return Redirect::route('admin.alarm.view')->with('message', '알림발송에 실패했습니다.');
        }
    }

}

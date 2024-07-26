<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Images;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * API 데이터 전송
     */
    public function toResult($data)
    {
        $result = [
            'data' => $data->get()->toArray(),
            'count' => $data->get()->count(),
        ];
        return $result;
    }

    /**
     * API 성공 메세지
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'result' => $result,
        ];


        return response()->json($response, Response::HTTP_OK);
    }


    /**
     * API 실패 시 메세지
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = Response::HTTP_NOT_FOUND)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    /**
     * 이미지 추가
     * $imageId = 업데이트 될 이미지 ID 목록
     * $targetType = 이미지 타겟
     * $targetId = 등록 ID
     */
    public function imageWithCreate($imageId, $targetType, $targetId)
    {
        if ($imageId != null) {
            // 이미지 업데이트
            Images::whereIn('id', $imageId)
                ->update([
                    'target_type' => $targetType,
                    'target_id' => $targetId,
                ]);
        }
    }

    /**
     * 글 수정 할 때 이미지 삭제 후 수정
     * $imageId = 업데이트 될 이미지 ID 목록
     * $targetType = 이미지 타겟
     * $targetId = 등록 ID
     */
    public function imageWithEdit($imageId, $targetType, $targetId)
    {
        if ($imageId != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            Images::where('target_id', '=', $targetId)
                ->where('target_type', '=', $targetType)->update([
                    'target_type' => null,
                    'target_id' => null,
                ]);

            Images::whereIn('id', $imageId)
                ->update([
                    'target_type' => $targetType,
                    'target_id' => $targetId,
                ]);
        }
    }

    /**
     * 이미지 추가
     * $imageId = 업데이트 될 이미지 ID 목록
     * $targetType = 이미지 타겟
     * $targetId = 등록 ID
     */
    public function imageTypeWithCreate($imageId, $targetType, $targetId, $type)
    {
        if ($imageId != null) {
            // 이미지 업데이트
            Images::whereIn('id', $imageId)
                ->update([
                    'target_type' => $targetType,
                    'target_id' => $targetId,
                    'type' => $type
                ]);
        }
    }

    /**
     * 글 수정 할 때 이미지 삭제 후 수정
     * $imageId = 업데이트 될 이미지 ID 목록
     * $targetType = 이미지 타겟
     * $targetId = 등록 ID
     */
    public function imageTypeWithEdit($imageId, $targetType, $targetId, $type)
    {
        if ($imageId != null) {
            // 기존 데이터 초기화 하고 이미지 업데이트
            Images::where('target_id', '=', $targetId)
                ->where('target_type', '=', $targetType)
                ->where('type', '=', $type)
                ->update([
                    'target_type' => null,
                    'target_id' => null,
                    'type' => null
                ]);

            Images::whereIn('id', $imageId)
                ->update([
                    'target_type' => $targetType,
                    'target_id' => $targetId,
                    'type' => $type
                ]);
        }
    }

    /**
     * 알림 발송
     */
    public function sendAlarm($iosFcmTokens, $androidFcmTokens, $data)
    {
        $messaging =  app('firebase.messaging');

        // 안드로이드
        if (count($androidFcmTokens) > 0) {
            $androidMessage = CloudMessage::fromArray([
                // 'notification' => ['title' => "앱이름", 'body' => '테스트 메세지' . 'notification'],
                'data' => $data
            ]);
            $response = $messaging->sendMulticast($androidMessage, $androidFcmTokens);

            // 오류 체크
            $validTokens = count($response->validTokens());
            $unknownTokens = count($response->unknownTokens());
            $invalidTokens = count($response->invalidTokens());

            Log::info('성공 토큰:' . $validTokens . ' - 알수 없는 토큰 수:' . $unknownTokens . '- 불가 토큰:' . $invalidTokens);
        } else {
            Log::info("안드로이드 알림 발송 실패");
        }

        // iOS
        if (count($iosFcmTokens) > 0) {
            $iosMessage = CloudMessage::fromArray([
                'notification' => $data,
                'data' => $data,
            ]);
            $response = $messaging->sendMulticast($iosMessage, $androidFcmTokens);

            // 오류 체크
            $validTokens = count($response->validTokens());
            $unknownTokens = count($response->unknownTokens());
            $invalidTokens = count($response->invalidTokens());

            Log::info('성공 토큰:' . $validTokens . ' - 알수 없는 토큰 수:' . $unknownTokens . '- 불가 토큰:' . $invalidTokens);
            Log::info("iOS 알림 발송 성공");
        } else {
            Log::info("iOS 알림 발송 실패");
        }
    }



    /*
    * response의 실패
    * {"status":300, "message":"필수 입력 값이 없습니다."}
    * 실패 코드번호, 내용
    *
    * status code 308 실패인 경우 인코딩 실패 문자열 return
    *  {"status":308, "message": "message EUC-KR 인코딩에 실패 하였습니다.\n msg_detail":풰(13)}
    *  실패 코드번호, 내용, 인코딩 실패 문자열(문자열 위치)
*/

    /*
    * response 성공
    * {"status":1}
    * 성공 코드번호 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
    *
    * 잘못된 번호가 포함된 경우
    * {"status":1, "message":"유효하지 않는 번호를 제외하고 발송 완료 하였습니다.\n error mobile : 01000000001aa, 010112"}
    * 성공 코드번호 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.), 내용(잘못된 데이터)
    *
*/

    /* status code
    1   : 정상발송 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
    300 : POST validation 실패
    301 : receiver 유효한 번호가 아님
    302 : api key or user is invalid
    303 : 분당 300건 이상 API 호출을 할 수 없습니다.
    304 : 대체문자 message validation 실패
    305 : 발신 프로필키 유효한 키가 아님
    306 : 잔액부족
    307 : return_url이 없음
    308 : 대체문자 utf-8 인코딩 에러 발생
    309 : 대체문자 message length = 0
    310 : 대체문자 euckr 인코딩 에러 발생
    311 : 대체문자 sender 유효한 번호가 아님
    312 : 대체문자 title validation 실패
    313 : 카카오 내용 validation 실패
    314 : 이미지 갯수 초과
    315 : 이미지 확장자 오류
    316 : 이미지 업로드 실패
    317 : 이미지 용량 300kb 초과
    318 : 예약정보가 유효하지 않습니다.
    319 : 동일 예약시간으로는 200회 이상 API 호출을 할 수 없습니다.
    999 : Internal Error.
 */
    public function kakaoSend($template_id, $user_phone, $user_name)
    {
        $ch = curl_init();

        $username = env('DIRECTSEND_ID');                //필수입력
        $key = env('DIRECTSEND_KEY');         //필수입력
        $kakao_plus_id = env('DIRECTSEND_PLUS_ID');            //필수입력
        $user_template_no = $template_id;            //필수입력 (하단 259 라인 API 이용하여 확인)

        //수신자 정보 추가 - 필수 입력(주소록 미사용시), 치환문자 미사용시 치환문자 데이터를 입력하지 않고 사용할수 있습니다.
        //치환문자 미사용시 "{"mobile":"01000000001"} 번호만 입력 해주시기 바랍니다.

        $receiverData = [
            "name" => $user_name,
            "mobile" => $user_phone,
        ];

        $receiver = json_encode($receiverData);

        $receiver = '[' . $receiver . ']';

        // 실제 발송성공실패 여부를 받기 원하실 경우 아래 주석을 해제하신 후, 사이트에 등록한 URL 번호를 입력해 주시기 바랍니다.
        // $return_url_yn = TRUE;        //return_url 사용시 필수 입력
        // $return_url = 0;

        /* 여기까지 수정해주시기 바랍니다. */

        $postarr = [
            "username" => $username,
            "key" => $key,
            "kakao_plus_id" => $kakao_plus_id,
            "user_template_no" => $user_template_no,
            "receiver" => $receiver
        ];


        $postvars = json_encode($postarr);   //JSON 데이터

        $url = "https://directsend.co.kr/index.php/api_v2/kakao_notice";         //URL

        //헤더정보
        $headers = array("cache-control: no-cache", "content-type: application/json; charset=utf-8");

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);


        //curl 에러 확인
        if (curl_errno($ch)) {
            Log::info('Curl error: ' . curl_error($ch));
        } else {
            Log::info($response);
        }

        curl_close($ch);
    }


    /**
     * 파일 추가
     * $fileId = 업데이트 될 파일 ID 목록
     * $targetType = 파일 타겟
     * $targetId = 등록 ID
     */
    public function fileWithCreate($fileId, $targetType, $targetId)
    {
        if ($fileId != null) {
            // 파일 업로드
            Files::whereIn('id', $fileId)
                ->update([
                    'target_type' => $targetType,
                    'target_id' => $targetId,
                ]);
        }
    }

    /**
     * 파일 업로드
     * $fileId = 업데이트 될 파일 ID 목록
     * $targetType = 파일 타겟
     * $targetId = 등록 ID
     */
    public function fileWithEdit($fileId, $targetType, $targetId)
    {
        // 기존 데이터 초기화 하고 파일 업데이트
        Files::where('target_id', '=', $targetId)
            ->where('target_type', '=', $targetType)->update([
                'target_type' => null,
                'target_id' => null,
            ]);
        if ($fileId != null) {
            Files::whereIn('id', $fileId)
                ->update([
                    'target_type' => $targetType,
                    'target_id' => $targetId,
                ]);
        }
    }
}

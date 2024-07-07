<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Images;
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

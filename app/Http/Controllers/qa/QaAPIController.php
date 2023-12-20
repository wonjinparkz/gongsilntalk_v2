<?php

namespace App\Http\Controllers\qa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qa;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| 1:1 문의 API
|--------------------------------------------------------------------------
|
| - 1:1 문의 목록 보기 (O)
| - 1:1 문의 상세 보기 (O)
| - 1:1 문의 등록 (O)
| - 1:1 문의 상세 (O)
|
*/

class QaAPIController extends Controller
{
    /**
     * 1:1 문의 목록 보기
     */
    public function qaList(Request $request)
    {
        $qaList = Qa::select();

        // 문의 작성자
        $qaList->where('users_id', Auth::guard('api')->user()->id);

        // 정렬
        $qaList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $qaList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, '1:1 문의 목록입니다.');
    }

    /**
     * 1:1 문의 내역 상세 보기
     */
    public function qaDetail(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $result = Qa::where('id', $request->id)->first();

        return $this->sendResponse($result, '1:1 문의 상세입니다.');
    }

    /**
     * 1:1 문의 등록
     */
    public function qaCreate(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:50',
            'content' => 'required|min:1|max:255',
            'category' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        // DB 추가
        $success = Qa::create([
            'users_id' => Auth::guard('api')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'is_reply' => 0 // 등록 시에는 0 (미답변)
        ]);

        return $this->sendResponse($success, "1:1 문의가 등록되었습니다.");
    }

    /**
     * 1:1 문의 삭제
     */
    public function qaDelete(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:qas,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $qa = Qa::where('id', $request->id)->first();

        if ($qa->users_id == Auth::guard('api')->user()->id) {
            $qa->delete();
            $success = $qa->refresh();
            return $this->sendResponse($success, "문의가 삭제되었습니다.");
        } else {
            return $this->sendError("삭제 권한이 없습니다.", $validator->errors()->all(), Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}

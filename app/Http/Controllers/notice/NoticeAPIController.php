<?php

namespace App\Http\Controllers\notice;

use App\Helper\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 공지사항 API
|--------------------------------------------------------------------------
|
| - 공지사항 목록 보기 (O)
| - 공지사항 상세보기 (O)
|
*/

class NoticeAPIController extends Controller
{
    /**
     * 공지사항 목록 보기
     */
    public function noticeList(Request $request)
    {

        // 오류 체크
        $validator = Validator::make($request->all(), [
            'type' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $noticeList = Notice::with('images')->select();

        // 공지사항 상태
        $noticeList->where('is_blind', 0);

        // 공지사항 타입
        $noticeList->where('type', $request->type);

        // 정렬
        $noticeList->orderBy('created_at', 'desc')->orderBy('id', 'desc');


        $result = $noticeList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, '공지사항 목록입니다.');
    }

    /**
     * 공지사항 상세 보기
     */
    public function noticeDetail(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $notice = Notice::with('images')->where('id', $request->id);
        $notice->increment('view_count', 1); // 조회수 증가
        $result = $notice->first();

        return $this->sendResponse($result, '공지사항 상세입니다.');
    }
}

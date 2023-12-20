<?php

namespace App\Http\Controllers\popup;

use App\Http\Controllers\Controller;
use App\Models\Popups;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 팝업 API
|--------------------------------------------------------------------------
|
| - 팝업 목록 보기 (O)
|
*/

class PopupAPIController extends Controller
{
    /**
     * 팝업 목록 보기
     */
    public function popupList(Request $request)
    {

        $popupList = Popups::with('images')->select();

        // 팝업 상태
        $popupList->where('is_blind', 0);

        // 타겟 유형
        if (isset($request->type)) {
            $popupList->where('type', $request->type);
        }

        // 정렬
        $popupList->orderBy('created_at', 'desc')->orderBy('id', 'desc');


        $result = $popupList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, '팝업 목록입니다.');
    }

}

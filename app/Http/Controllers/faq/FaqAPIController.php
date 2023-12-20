<?php

namespace App\Http\Controllers\faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API - FAQ
|--------------------------------------------------------------------------
|
| - FAQ 목록 보기
|
*/

class FaqAPIController extends Controller
{
    /**
     * FAQ 목록 보기
     */
    public function faqList(Request $request)
    {
        $faqList = Faq::select();

        // FAQ 상태
        $faqList->where('is_blind', 0);

        // 타겟 유형
        if (isset($request->type)) {
            $faqList->where('type', $request->type);
        }
        // 정렬
        $faqList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $faqList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, 'FAQ 목록입니다.');
    }
}

<?php

namespace App\Http\Controllers\knowledgecenter;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeCenter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| 관리자 - 지식산업 센터
|--------------------------------------------------------------------------
|
| - 지식산업 센터 목록 보기 ()
| - 지식산업 센터 상세 화면 보기 ()
| - 지식산업 센터 등록 화면 조회 ()
| - 지식산업 센터 등록 ()
| - 지식산업 센터 수정 ()
| - 지식산업 센터 상태 수정 ()
| - 지식산업 센터 삭제 ()
|
*/


class KnowledgeCneter_Controller extends Controller
{
    /**
     * 지식산업 센터 목록 보기
     */
    public function knowledgeCenterListView(Request $request): View
    {
        $konwledgeCenterList = KnowledgeCenter::select();

         // 정렬
         $konwledgeCenterList->orderBy('faqs.created_at', 'desc')->orderBy('id', 'asc');

         $result = $konwledgeCenterList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('admin.knowledgeCenter.knowledgeCenter-list', compact('result'));
    }

    /**
     * 지식산업 센터 등록 화면 조회
     */
    public function createView(): View
    {
        return view('admin.knowledgeCenter.knowledgeCenter-create');
    }
}

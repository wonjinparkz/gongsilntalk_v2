<?php

namespace App\Http\Controllers\consulting;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ConsultingPcController extends Controller
{
    // 상담문의 등록 페이지
    public function cosultingCreateView(): View
    {
        return view('www.consulting.consulting_create');
    }

    // 상담문의 등록
    public function cosultingCreate(): RedirectResponse
    {
        return Redirect::route('www.main.main')->with('message', '상담문의를 등록했습니다.');
    }
}

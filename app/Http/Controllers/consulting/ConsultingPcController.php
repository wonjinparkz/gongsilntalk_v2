<?php

namespace App\Http\Controllers\consulting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultingPcController extends Controller
{
    // 상담문의 등록 페이지
    public function cosultingCreateView(): View
    {
        return view('www.consulting.consulting_create');
    }
}

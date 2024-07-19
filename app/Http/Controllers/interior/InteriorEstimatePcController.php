<?php

namespace App\Http\Controllers\interior;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InteriorEstimatePcController extends Controller
{
    /**
     * 인테리어 견적 등록 페이지
     */
    public function interiorEstimateCreateView():View
    {
        return view('www.interior.interior_estimate_create');
    }
}

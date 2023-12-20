<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdaminDashboardController extends Controller
{
    /**
     * 화면 조회
     */
    public function dashboard():View {
        return view('admin.dashboard.dashboard');
    }
}

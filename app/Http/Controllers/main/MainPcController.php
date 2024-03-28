<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainPcController extends Controller
{
    public function mainView(): View
    {
        return view('www.main.main');
    }
}

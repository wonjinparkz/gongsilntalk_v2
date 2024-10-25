<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\MainText;
use App\Models\Popups;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainPcController extends Controller
{
    public function mainView(): View
    {
        // 메인 배너 섹션 - section 1
        $banner_main = Banners::with('images')->where('type', 0)->where('is_blind', 0)->orderBy('order')->get();
        $banner_bottom = Banners::with('images')->where('type', 1)->where('is_blind', 0)->orderBy('order')->get();

        // 메인 서비스 기능 설명 섹션 - section 2
        // type 서비스 타입 - 0: 메인
        // 최대 5개
        $banner_service =  Service::with('images')->where('is_blind', 0)->where('type', 0)->orderBy('order')->take(5)->get();

        // 메인 텍스트 노출 섹션 - section 3
        $banner_text = MainText::orderBy('order')->get();

        // 부가서비스 섹션 - section 5
        // type 서비스 타입 - 1: 추천 분양현장, 2:실시간 매물지도, 3: 내 자산관리, 4: 수익률 계산기
        $banner_extra_service = Service::with('images')->where('is_blind', 0)->whereIn('type', [1, 2, 3, 4])->orderBy('order')->get();

        $app_download = Service::with('images')
            ->select()
            ->where('is_blind', 0)
            ->where('type', 5)
            ->first();

        // 시작팝업 이미지
        $popups = Popups::with('images')
            ->where('is_blind', 0)
            ->orderBy('order')
            ->get();

        return view('www.main.main', compact('banner_main', 'banner_bottom', 'banner_service', 'banner_text', 'banner_extra_service', 'popups', 'app_download'));
    }
}

<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\MainText;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainPcController extends Controller
{
    public function mainView(): View
    {
        // 메인 배너 섹션
        $banner_main = Banners::with('images')->where('is_blind', 0)->orderby('order')->get();

        // 메인 서비스 기능 설명 섹션
        // type 서비스 타입 - 0: 메인, 1: 추천 분양현장, 2:실시간 매물지도, 3: 내 자산관리, 4: 수익률 계산기
        $banner_service = Service::where('is_blind', 0)->orderby('order')->get();

        // 메인 텍스트 노출 섹션
        $banner_text = MainText::orderby('order')->get();

        // // 매물 지도 바로가기 섹션
        // $banner_main = Banners::where('is_blind', 0)->orderby('order')->get();

        // // 퍼시스, 인테리어 견적서 받기 섹션
        // $banner_main = Banners::where('is_blind', 0)->orderby('order')->get();

        // // 부가서비스 섹션
        // $banner_main = Banners::where('is_blind', 0)->orderby('order')->get();

        // // 외부 사이트 연결 섹션
        // $banner_main = Banners::where('is_blind', 0)->orderby('order')->get();

        // // 사용자 리뷰 섹션
        // $banner_main = Banners::where('is_blind', 0)->orderby('order')->get();

        return view('www.main.main', compact('banner_main', 'banner_service', 'banner_text'));
    }
}

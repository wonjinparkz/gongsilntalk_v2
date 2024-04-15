<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserPcController extends Controller
{
    /**
     * 내 매물 관리
     */
    public function productMagagementListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.productMagagement_list', compact('user'));
    }

    /**
     * 중개사 매물 관리
     */
    public function corpProductMagagementListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.corpProductMagagement_list', compact('user'));
    }

    /**
     * 관심매물/최근 본 매물
     */
    public function productInterestListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.productInterest_list', compact('user'));
    }

    /**
     * 기업 이전 제안서
     */
    public function corpProposalListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.corpProposal_list', compact('user'));
    }

    /**
     * 내 자산관리
     */
    public function serviceListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.service_list', compact('user'));
    }

    /**
     * 매물 제안서
     */
    public function proposalListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.proposal_list', compact('user'));
    }

    /**
     * 수익률 계산기
     */
    public function calculatorRevenueListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.calculatorRevenue_list', compact('user'));
    }

    /**
     * 내 정보 수정
     */
    public function myInfoView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.my_info', compact('user'));
    }

    /**
     * 중개사 내 정보 수정
     */
    public function companyInfoView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.company_info', compact('user'));
    }

    /**
     * 커뮤니티 게시글 관리
     */
    public function communityListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.community_list', compact('user'));
    }

    /**
     * 커뮤니티 게시글 관리
     */
    public function alarmListView(): View
    {
        // 회원 정보
        $user = User::select()
        ->where('users.id', Auth::guard('web')->user()->id)
        ->first();

        return view('www.mypage.alarm_list', compact('user'));
    }
}

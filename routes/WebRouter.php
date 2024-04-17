<?php

use App\Http\Controllers\auth\PasswordResetController;
use App\Http\Controllers\auth\UserAuthPcController;
use App\Http\Controllers\commons\LikePcController;
use App\Http\Controllers\commons\PopupOpenController;
use App\Http\Controllers\commons\VerificationController;
use App\Http\Controllers\community\CommunityPcController;
use App\Http\Controllers\main\MainPcController;
use App\Http\Controllers\product\ProductPcController;
use App\Http\Controllers\terms\TermsController;
use App\Http\Controllers\user\UserPcController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/{path?}',function(){
//     return view('app');
// })->where('path', '^(?!admin|api).*$');

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * 메인
 */
Route::controller(MainPcController::class)->group(function () {
    Route::get('/', 'mainView')->name('www.main.main');
    // Route::get('/main/search', 'mainSearch')->name('www.main.search');
});

/**
 * 회원 인증
 */
Route::controller(UserAuthPcController::class)->group(function () {

    // 로그인
    Route::middleware('pc.check')->get('/login', 'loginView')->name('www.login.login');
    Route::post('/login/send', 'login')->name('www.login.create');
    // 로그아웃
    Route::middleware('pc.auth')->get('/logout', 'logout')->name('www.logout.logout');
    // 회원가입
    Route::get('/register/register', 'joinView')->name('www.register.register');
    Route::post('/register/create', 'register')->name('www.register.create');
    Route::post('/register/nickname/{nickname}', 'nicknameCheck')->name('www.register.nickname');

    //소셜 로그인
    Route::get('/kakao', 'kakaoLogin')->name('www.login.kakao');
    Route::get('/kakao/oauth', 'kakaoCallback');

    Route::get('/naver', 'naverLogin')->name('www.login.naver');
    Route::get('/naver/oauth', 'naverCallback');

    Route::get('/apple', 'appleLogin')->name('www.login.apple');
    Route::get('/apple/oauth', 'appleCallback');
});

// 매물
Route::middleware('pc.auth')->controller(ProductPcController::class)->group(function () {
    Route::get('/product/create/view', 'productCreateView')->name('www.product.create.view');
    Route::post('/product/create/type/check', 'productCreateTypeCheck')->name('www.product.create.type.check');
});

// 커뮤니티
Route::controller(CommunityPcController::class)->group(function () {
    Route::get('/community/list', 'communityListView')->name('www.community.list.view');
    Route::get('/community/search', 'communitySearchView')->name('www.community.search.view');
    Route::get('/community/search/list', 'communitySearchListView')->name('www.community.search.list.view');
    Route::middleware('pc.auth')->get('/community/create', 'communityCreateView')->name('www.community.create.view');
    Route::middleware('pc.auth')->post('/community/create', 'communityCreate')->name('www.community.create');
    Route::middleware('pc.auth')->get('/community/update/{id}', 'communityUpdateView')->name('www.community.update.view');
    Route::middleware('pc.auth')->post('/community/update', 'communityUpdate')->name('www.community.update');
    Route::get('/community/detail', 'communityDetailView')->name('www.community.detail.view');
});

/**
 * 마이페이지
 */
Route::middleware('pc.auth')->controller(UserPcController::class)->group(function () {
    Route::get('/mypage/main', 'mypageMainView')->name('www.mypage.mian.view');
    Route::get('/mypage/product/magagement/list', 'productMagagementListView')->name('www.mypage.product.magagement.list.view');
    Route::get('/mypage/corp/product/magagement/list', 'corpProductMagagementListView')->name('www.mypage.corp.product.magagement.list.view');
    Route::get('/mypage/product/interest/list', 'productInterestListView')->name('www.mypage.product.interest.list.view');
    Route::get('/mypage/corp/proposal/list', 'corpProposalListView')->name('www.mypage.corp.proposal.list.view');
    Route::get('/mypage/service/list', 'serviceListView')->name('www.mypage.service.list.view');
    Route::get('/mypage/proposal/list', 'proposalListView')->name('www.mypage.proposal.list.view');
    Route::get('/mypage/calculator/revenue/list', 'calculatorRevenueListView')->name('www.mypage.calculator.revenue.list.view');
    Route::get('/mypage/my/info', 'myInfoView')->name('www.mypage.my.info');
    Route::get('/mypage/company/info', 'companyInfoView')->name('www.mypage.company.info');
    Route::get('/mypage/community/list', 'communityListView')->name('www.mypage.community.list.view');
    Route::get('/mypage/alarm/list', 'alarmListView')->name('www.mypage.alarm.list.view');
});



/**
 * 이용약관
 */
Route::controller(TermsController::class)->group(function () {
    Route::get('/terms/preview/{kind}/{type}/{id?}', 'termsPreview')->name('terms.preview');
});

/**
 * 비밀번호 초기화
 */
Route::controller(PasswordResetController::class)->group(function () {
    Route::get('/password/reset/view', 'passwordResetView')->name('password.reset.view');
    Route::get('/password/expire', 'passwordExpireView')->name('password.expire.view');
    Route::post('/password/reset', 'passwordReset')->name('password.reset');
});

/**
 * 본인 인증
 */
Route::controller(VerificationController::class)->group(function () {
    Route::get('/verification/start', 'verificationStart')->name('www.verification.start');
    Route::get('/verification/reuslt', 'verificationResult')->name('www.verification.result');
});


/**
 * 좋아요
 */
Route::middleware('pc.auth')->controller(LikePcController::class)->group(function () {
    Route::post('/like', 'like')->name('www.commons.like'); // 좋아요 등록/해제
    Route::get('/like/list', 'list'); // 좋아요 목록 보기
});

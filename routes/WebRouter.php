<?php

use App\Http\Controllers\auth\PasswordResetController;
use App\Http\Controllers\auth\UserAuthPcController;
use App\Http\Controllers\commons\LikePcController;
use App\Http\Controllers\commons\PopupOpenController;
use App\Http\Controllers\commons\VerificationController;
use App\Http\Controllers\community\CommunityPcController;
use App\Http\Controllers\main\MainPcController;
use App\Http\Controllers\product\ProductPcController;
use App\Http\Controllers\proposal\ProposalPcController;
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
    Route::get('/map', 'map')->name('www.map.map');

    // 로그인
    Route::middleware('pc.check')->get('/login', 'loginView')->name('www.login.login');
    Route::post('/login/send', 'login')->name('www.login.create');
    // 로그아웃
    Route::middleware('pc.auth')->get('/logout', 'logout')->name('www.logout.logout');
    // 회원가입
    Route::get('/register/register', 'joinView')->name('www.register.register.view');
    Route::post('/register/create', 'register')->name('www.register.create');
    Route::post('/register/nickname/{nickname}', 'nicknameCheck')->name('www.register.nickname');
    Route::get('register/complete', 'registerComplete')->name('www.register.complete');

    // 중개사 회원가입
    Route::get('/register/corp/register', 'corpJoinView')->name('www.register.corp.register.view');
    Route::post('/register/join/check', 'corpJoinCheck')->name('www.register.join.check');
    Route::get('/register/corp/register2', 'corpJoinView2')->name('www.register.corp.register2.view');
    Route::post('/register/corp/create', 'registerCorp')->name('www.register.corp.create');
    Route::get('register/complete/corp', 'registerCompleteCorp')->name('www.register.complete.corp');


    //소셜 로그인
    Route::get('/kakao', 'kakaoLogin')->name('www.login.kakao');
    Route::get('/kakao/oauth', 'kakaoCallback');

    Route::get('/naver', 'naverLogin')->name('www.login.naver');
    Route::get('/naver/oauth', 'naverCallback');

    Route::get('/apple', 'appleLogin')->name('www.login.apple');
    Route::get('/apple/oauth', 'appleCallback');
});

// 일반회원 매물
Route::middleware('pc.auth')->controller(ProductPcController::class)->group(function () {
    Route::get('/product/create/view', 'productCreateView')->name('www.product.create.view');
    Route::get('/product/create2/view', 'productCreate2View')->name('www.product.create2.view');
    Route::get('/product/create3/view', 'productCreate3View')->name('www.product.create3.view');
    Route::post('/product/create/type/check', 'productCreateTypeCheck')->name('www.product.create.type.check');
    Route::post('/product/create/address/check', 'productCreateAddressCheck')->name('www.product.create.address.check');
    Route::post('/product/create', 'productCreate')->name('www.product.create');
});

// 중개사 매물
Route::middleware('pc.auth')->controller(ProductPcController::class)->group(function () {
    Route::get('/corp/product/create/view', 'corpProductCreateView')->name('www.corp.product.create.view');
    Route::get('/corp/product/create2/view', 'corpProductCreate2View')->name('www.corp.product.create2.view');
    Route::get('/corp/product/create3/view', 'corpProductCreate3View')->name('www.corp.product.create3.view');
    Route::get('/corp/product/create4/view', 'corpProductCreate4View')->name('www.corp.product.create4.view');
    Route::get('/corp/product/create5/view', 'corpProductCreate5View')->name('www.corp.product.create5.view');
    Route::post('/corp/product/create/type/check', 'corpProductCreateTypeCheck')->name('www.corp.product.create.type.check');
    Route::post('/corp/product/create/address/check', 'corpProductCreateAddressCheck')->name('www.corp.product.create.address.check');
    Route::post('/corp/product/create/info/check', 'corpProductCreateInfoCheck')->name('www.corp.product.create.info.check');
    Route::post('/corp/product/create/add/info/check', 'corpProductCreateAddInfoCheck')->name('www.corp.product.create.add.info.check');
    Route::post('/corp/product/create', 'corpProductCreate')->name('www.corp.product.create');
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
    Route::middleware('pc.auth')->get('/community/delete', 'communityDelete')->name('www.community.delete');
    Route::middleware('pc.auth')->post('/community/report', 'communityReport')->name('www.community.report');
    Route::middleware('pc.auth')->get('/community/block', 'communityBlock')->name('www.community.block');

    Route::middleware('pc.auth')->post('/reply/create', 'replyCreate')->name('www.reply.create');
    Route::middleware('pc.auth')->post('/reply/report', 'replyReport')->name('www.reply.report');
    Route::middleware('pc.auth')->get('/reply/block', 'replyBlock')->name('www.reply.block');
    Route::middleware('pc.auth')->get('/reply/delete', 'replyDelete')->name('www.reply.delete');
});

/**
 * 마이페이지
 */
Route::middleware('pc.auth')->controller(UserPcController::class)->group(function () {
    Route::get('/mypage/main', 'mypageMainView')->name('www.mypage.mian.view');
    Route::get('/mypage/product/magagement/list', 'productMagagementListView')->name('www.mypage.product.magagement.list.view');
    Route::get('/mypage/corp/product/magagement/list', 'corpProductMagagementListView')->name('www.mypage.corp.product.magagement.list.view');

    // 관심 매물/최근 본 매물
    Route::get('/mypage/product/interest/list', 'productInterestListView')->name('www.mypage.product.interest.list.view');
    Route::get('/mypage/product/recently/list', 'productRecentlyListView')->name('www.mypage.product.recently.list.view');

    // 내 자산 관리
    Route::get('/my-asset/address/list', 'addressList')->name('www.my.address.list');
    Route::get('/mypage/service/list', 'serviceListView')->name('www.mypage.service.list.view');
    Route::get('/mypage/service/detail/{id}', 'serviceDetailView')->name('www.mypage.service.detail.view');
    Route::post('/mypage/service/delete', 'addressDelete')->name('www.mypage.service.delete');
    Route::post('/mypage/service/one-delete', 'addressOneDelete')->name('www.mypage.service.one.delete');

    Route::get('/mypage/service/create-first', 'serviceFirstCreateView')->name('www.mypage.service.create.first.view');
    Route::get('/mypage/service/create-second', 'serviceSecondCreateView')->name('www.mypage.service.create.second.view');
    Route::get('/mypage/service/create-third', 'serviceThirdCreateView')->name('www.mypage.service.create.third.view');
    Route::get('/mypage/service/create-fourth', 'serviceFourthCreateView')->name('www.mypage.service.create.fourth.view');
    Route::post('/mypage/service/create', 'serviceCreate')->name('www.mypage.service.create');

    Route::get('/mypage/service/update-first/{id}', 'serviceFirstUpdateView')->name('www.mypage.service.update.first.view');
    Route::get('/mypage/service/update-second', 'serviceSecondUpdateView')->name('www.mypage.service.update.second.view');
    Route::get('/mypage/service/update-third', 'serviceThirdUpdateView')->name('www.mypage.service.update.third.view');
    Route::get('/mypage/service/update-fourth', 'serviceFourthUpdateView')->name('www.mypage.service.update.fourth.view');
    Route::post('/mypage/service/update', 'serviceUpdate')->name('www.mypage.service.update');

    // 중개사 기업 이전 제안서
    Route::get('/mypage/corp/proposal/list', 'corpProposalListView')->name('www.mypage.corp.proposal.list.view');
    Route::post('/mypage/proposal/delete', 'corpProposalDelete')->name('www.mypage.proposal.delete');

    Route::get('/mypage/proposal/list', 'proposalListView')->name('www.mypage.proposal.list.view');

    // 수익률 계산기
    Route::get('/mypage/calculator/revenue/list', 'calculatorRevenueListView')->name('www.mypage.calculator.revenue.list.view');
    Route::post('/mypage/calculator/revenue/create', 'calculatorRevenueCreate')->name('www.calculator.revenue.create');
    Route::post('/mypage/calculator/revenue/delete', 'calculatorRevenueDelete')->name('www.calculator.revenue.delete');

    // 대출 이자 계산기
    Route::get('/mypage/calculator/loan/list', 'calculatorLoanListView')->name('www.mypage.calculator.loan.list.view');
    Route::post('/mypage/calculator/loan/create', 'calculatorLoanCreate')->name('www.calculator.loan.create');
    Route::post('/mypage/calculator/loan/delete', 'calculatorLoanDelete')->name('www.calculator.loan.delete');

    Route::get('/mypage/my/info', 'myInfoView')->name('www.mypage.my.info');
    Route::get('/mypage/company/info', 'companyInfoView')->name('www.mypage.company.info');
    Route::get('/mypage/community/list', 'communityListView')->name('www.mypage.community.list.view');
    Route::get('/mypage/alarm/list', 'alarmListView')->name('www.mypage.alarm.list.view');
});

Route::middleware('pc.auth')->controller(ProposalPcController::class)->group(function () {
    // 중개사 기업 이전 제안서
    Route::post('/corp/proposal/create', 'corpProposalCreate')->name('www.corp.proposal.create');
    Route::get('/corp/proposal/product/create/{id}', 'corpProposalProductCreateView')->name('www.corp.proposal.product.create.view');
    Route::get('/corp/proposal/product/create2', 'corpProposalProductCreate2View')->name('www.corp.proposal.product.create2.view');
    Route::get('/corp/proposal/product/create3', 'corpProposalProductCreate3View')->name('www.corp.proposal.product.create3.view');
    Route::get('/mypage/corp/proposalproduct/list/{id}', 'corpProposalProductListView')->name('www.mypage.corp.proposalproduct.list.view');
    Route::post('/corp/proposal/product/create/type/check', 'corpProposalProductCreateTypeCheck')->name('www.corp.proposal.product.create.type.check');
    Route::post('/corp/proposal/product/name-update', 'corpProposalNameUpdate')->name('www.corp.proposal.name.update');
    Route::post('/corp/proposal/product/create', 'corpProposalProductCreate')->name('www.corp.proposal.name.create');
    Route::get('/mypage/corp/proposal/type/{id}', 'corpProposalTypeDetailView')->name('www.mypage.corp.proposal.type.detail.view');

    Route::post('/corp/proposal/product/create/info/check', 'corpProposalProductCreateinfoCheck')->name('www.corp.proposal.product.create.info.check');
    Route::post('/corp/proposal/product/create/price/check', 'corpProposalProductCreatePriceCheck')->name('www.corp.proposal.product.create.price.check');
    Route::post('/corp/proposal/product/delete', 'corpProposalDelete')->name('www.corp.proposal.product.delete');

    // 사용자 매물 제안서
    Route::get('/mypage/proposal/offer-first', 'userProposalCreateFirst')->name('www.mypage.user.offer.first.create.view');
    Route::get('/mypage/proposal/offer-second', 'userProposalCreateSecond')->name('www.mypage.user.offer.second.create.view');
    Route::get('/mypage/proposal/offer-third', 'userProposalCreateThird')->name('www.mypage.user.offer.third.create.view');
    Route::post('/mypage/proposal/create', 'userProposalCreate')->name('www.mypage.user.offer.create');
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
    Route::post('/password/user/check', 'passwordUserCheck')->name('password.user.check');
    Route::post('/password/change', 'passwordChange')->name('password.change');
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

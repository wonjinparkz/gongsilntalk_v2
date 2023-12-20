<?php

use App\Http\Controllers\alarm\AlaramController;
use App\Http\Controllers\dashboard\AdaminDashboardController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\community\CommunityCategoryController;
use App\Http\Controllers\community\CommunityController;
use App\Http\Controllers\faq\FaqController;
use App\Http\Controllers\qa\QaController;
use App\Http\Controllers\notice\NoticeController;
use App\Http\Controllers\popup\PopupController;
use App\Http\Controllers\banner\BannerController;
use App\Http\Controllers\magazine\MagazineController;
use App\Http\Controllers\magazine\MagazineCategoryController;
use App\Http\Controllers\terms\TermsController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 관리자 라우터
|
*/

/**
 * 관리자 로그인
 */
Route::middleware('admin.check')->controller(AdminAuthController::class)->group(function () {
    Route::get('/', 'view')->name('admin.login');
    Route::get('/login', 'view')->name('admin.login.view');
    Route::post('/login', 'login')->name('admin.login.login');
});

/**
 * 관리자 로그아웃
 */
Route::controller(AdminAuthController::class)->group(function () {
    Route::get('/logout', 'logout')->name('admin.login.logout');
});


/**
 * 관리자 메인 화면
 */
Route::middleware('admin.auth')->controller(AdaminDashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard.view');
});

/**
 * 관리자 사용자 관리
 */
Route::middleware('admin.auth')->controller(UserController::class)->group(function () {
    Route::get('/user/list/view', 'userListView')->name('admin.user.list.view');
    Route::get('/user/detail/view/{id}', 'userdetailView')->name('admin.user.detail.view');
    Route::post('/user/state/update', 'userStateUpdate')->name('admin.user.state.update');
});


/**
 * 관리자 커뮤니티 카테고리
 */
Route::middleware('admin.auth')->controller(CommunityCategoryController::class)->group(function () {
    Route::get('/community/category/list', 'listView')->name('admin.community.category.list.view');
    Route::get('/community/category/detail/{id}', 'detailView')->name('admin.community.category.detail.view');
    Route::get('/community/category/create', 'createView')->name('admin.community.category.create.view');
    Route::post('/community/category/create', 'create')->name('admin.community.category.create');
    Route::post('/community/category/delete', 'delete')->name('admin.community.category.delete');
    Route::post('/community/category/update', 'update')->name('admin.community.category.update');
    Route::post('/community/category/update/state', 'updateState')->name('admin.community.category.update.state');
});

/**
 * 관리자 커뮤니티 목록 관리
 */
Route::middleware('admin.auth')->controller(CommunityController::class)->group(function () {
    Route::get('/community/list', 'listView')->name('admin.community.list.view');
    Route::get('/community/detail/{id}', 'detailView')->name('admin.community.detail.view');
    Route::post('/community/update', 'update')->name('admin.community.update');
    Route::post('/community/update/state', 'updateState')->name('admin.community.update.state');
    Route::post('/community/reply/update/state', 'replyUpdateState')->name('admin.community.reply.update.state');
});

/**
 * 관리자 매거진 카테고리
 */
Route::middleware('admin.auth')->controller(MagazineCategoryController::class)->group(function () {
    Route::get('/magazine/category/list/view', 'magazineCategoryListView')->name('admin.magazine.category.list.view');
    Route::post('/magazine/category/create', 'magazineCategoryCreate')->name('admin.magazine.category.create');
    Route::post('/magazine/category/delete', 'magazineCategoryDelete')->name('admin.magazine.category.delete');
    Route::post('/magazine/category/order/update', 'magazineCategoryOrderUpdate')->name('admin.magazine.category.order.update');
    Route::post('/magazine/category/title/update', 'magazineCategoryTitleUpdate')->name('admin.magazine.category.title.update');
    Route::post('/magazine/category/state/update', 'magazineCategoryStateUpdate')->name('admin.magazine.category.state.update');
});

/**
 * 관리자 매거진 카테고리
 */
Route::middleware('admin.auth')->controller(MagazineController::class)->group(function () {
    Route::get('/magazine/list/view', 'magazineListView')->name('admin.magazine.list.view');
    Route::get('/magazine/detail/view/{id}', 'magazineDetailView')->name('admin.magazine.detail.view');
    Route::get('/magazine/create/view', 'magazineCreateView')->name('admin.magazine.create.view');
    Route::post('/magazine/create', 'magazineCreate')->name('admin.magazine.create');
    Route::post('/magazine/update', 'magazineUpdate')->name('admin.magazine.update');
    Route::post('/magazine/state/update', 'magazineStateUpdate')->name('admin.magazine.state.update');
    Route::post('/magazine/delete', 'magazineDelete')->name('admin.magazine.delete');
});


/**
 * 관리자 공지 사항
 */
Route::middleware('admin.auth')->controller(NoticeController::class)->group(function () {
    Route::get('/notice/list/view', 'noticeListView')->name('admin.notice.list.view');
    Route::get('/notice/detail/view/{id}', 'noticeDetailView')->name('admin.notice.detail.view');
    Route::get('/notice/create/view', 'noticeCreateView')->name('admin.notice.create.view');
    Route::post('/notice/create', 'noticeCreate')->name('admin.notice.create');
    Route::post('/notice/update', 'noticeUpdate')->name('admin.notice.update');
    Route::post('/notice/state/update/', 'noticeStateUpdate')->name('admin.notice.state.update');
    Route::post('/notice/delete', 'noticeDelete')->name('admin.notice.delete');
});

/**
 * 관리자 FAQ
 */
Route::middleware('admin.auth')->controller(FaqController::class)->group(function () {
    Route::get('/faq/list/view', 'faqListView')->name('admin.faq.list.view');
    Route::get('/faq/detail/view/{id}', 'faqDetailView')->name('admin.faq.detail.view');
    Route::get('/faq/create/view', 'faqCreateView')->name('admin.faq.create.view');
    Route::post('/faq/create', 'faqCreate')->name('admin.faq.create');
    Route::post('/faq/update', 'faqUpdate')->name('admin.faq.update');
    Route::post('/faq/state/update', 'faqStateUpdate')->name('admin.faq.state.update');
    Route::post('/faq/delete', 'faqDelete')->name('admin.faq.delete');
});

/**
 * 관리자 1:1 문의 관리
 */
Route::middleware('admin.auth')->controller(QaController::class)->group(function () {
    Route::get('/qa/list/view', 'qaListView')->name('admin.qa.list.view');
    Route::get('/qa/detail/view/{id}', 'qaDetailView')->name('admin.qa.detail.view');
    Route::post('/qa/replyupdate', 'qaReplyUpdate')->name('admin.qa.reply.update');
    Route::post('/qa/reply/delete', 'qaReplyDelete')->name('admin.qa.reply.delete');
});


/**
 * 관리자 약관 관리
 */
Route::middleware('admin.auth')->controller(TermsController::class)->group(function () {
    Route::get('/terms/list/view', 'termsListView')->name('admin.terms.list.view');
    Route::get('/terms/detail/view/{id}', 'termsDetailView')->name('admin.terms.detail.view');
    Route::get('/terms/create/view', 'termsCreateView')->name('admin.terms.create.view');
    Route::post('/terms/create', 'termsCreate')->name('admin.terms.create');
    Route::post('/terms/update', 'termsUpdate')->name('admin.terms.update');
    Route::post('/terms/delete', 'termsDelete')->name('admin.terms.delete');
});

/**
 * 관리자 알림 관리
 */
Route::middleware('admin.auth')->controller(AlaramController::class)->group(function () {
    Route::get('/alarm/view', 'view')->name('admin.alarm.view');
    Route::post('/alarm/send', 'send')->name('admin.alarm.send');
});


/**
 * 팝업 관리
 */
Route::middleware('admin.auth')->controller(PopupController::class)->group(function () {
    Route::get('/popup/list/view', 'popupListView')->name('admin.popup.list.view');
    Route::get('/popup/detail/view/{id}', 'popupDetailView')->name('admin.popup.detail.view');
    Route::get('/popup/create/view', 'popupCreateView')->name('admin.popup.create.view');
    Route::post('/popup/create', 'popupCreate')->name('admin.popup.create');
    Route::post('/popup/update', 'popupUpdate')->name('admin.popup.update');
    Route::post('/popup/delete', 'popupDelete')->name('admin.popup.delete');
    Route::post('/popup/state/update', 'popupStateupdate')->name('admin.popup.state.update');
});

/**
 * 배너 관리
 */
Route::middleware('admin.auth')->controller(BannerController::class)->group(function () {
    Route::get('/banner/list/view', 'bannerListView')->name('admin.banner.list.view');
    Route::get('/banner/detail/view/{id}', 'bannerDetailView')->name('admin.banner.detail.view');
    Route::get('/banner/create/view', 'bannerCreateView')->name('admin.banner.create.view');
    Route::post('/banner/create', 'bannerCreate')->name('admin.banner.create');
    Route::post('/banner/update', 'bannerUpdate')->name('admin.banner.update');
    Route::post('/banner/delete', 'bannerDelete')->name('admin.banner.delete');
    Route::post('/banner/update/state', 'bannerStateUpdate')->name('admin.banner.state.update');
});

/**
 * 관리자 관리
 */
Route::middleware('admin.auth')->controller(AdminController::class)->group(function () {
    Route::get('/admins/list/view', 'adminListView')->name('admins.list.view');
    Route::get('/admins/detail/view/{id}', 'admindetailView')->name('admins.detail.view');
    Route::get('/admins/create/view', 'adminCreateView')->name('admins.create.view');
    Route::post('/admins/create', 'adminCreate')->name('admins.create');
    Route::post('/admins/delete', 'adminDelete')->name('admins.delete');
    Route::post('/admins/update', 'adminUpdate')->name('admins.update');
    Route::post('/admins/state/update', 'adminStateUpdate')->name('admins.state.update');
    Route::post('/admins/password/update', 'adminPasswordUpdate')->name('admins.password.update');

    Route::get('/admins/me/{id}', 'me')->name('admins.me.view');
    Route::post('/admins/update/me', 'updateMe')->name('admins.update.me');
});

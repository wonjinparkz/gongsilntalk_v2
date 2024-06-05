<?php

use App\Http\Controllers\alarm\AlaramController;
use App\Http\Controllers\dashboard\AdaminDashboardController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\apt\AptController;
use App\Http\Controllers\community\CommunityCategoryController;
use App\Http\Controllers\community\CommunityController;
use App\Http\Controllers\faq\FaqController;
use App\Http\Controllers\qa\QaController;
use App\Http\Controllers\notice\NoticeController;
use App\Http\Controllers\popup\PopupController;
use App\Http\Controllers\banner\BannerController;
use App\Http\Controllers\buildingledger\BuildingledgerController;
use App\Http\Controllers\commons\PopupOpenController;
use App\Http\Controllers\data\DataController;
use App\Http\Controllers\knowledgecenter\KnowledgeCneter_Controller;
use App\Http\Controllers\magazine\MagazineController;
use App\Http\Controllers\maintext\MainTextController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\proposal\ProposalController;
use App\Http\Controllers\report\ReportController;
use App\Http\Controllers\service\ServiceController;
use App\Http\Controllers\SiteProduct\SiteProductController;
use App\Http\Controllers\terms\TermsController;
use App\Http\Controllers\user\UserController;
use App\Models\Product;
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
    Route::post('/user/memo/update', 'userMemoUpdate')->name('admin.user.memo.update');
    Route::get('/user/export', 'exportUser')->name('admin.user.export');

    // 중개사
    Route::get('/corp/list/view', 'corpListView')->name('admin.corp.list.view');
    Route::get('/corp/export', 'exportCorp')->name('admin.corp.export');

    // 중개사 승인
    Route::get('/company/list/view', 'companyListView')->name('admin.company.list.view');
    Route::get('/company/detail/view/{id}', 'companydetailView')->name('admin.corp.detail.view');
    Route::post('/company/state/update', 'companyStateUpdate')->name('admin.company.update.state');
    Route::get('/company/export', 'exportCompany')->name('admin.company.export');
});


/**
 * 매물 관리
 */
Route::middleware('admin.auth')->controller(ProductController::class)->group(function () {
    Route::get('/product/list/view', 'productListView')->name('admin.product.list.view');
    Route::get('/product/detail/view/{id}', 'productDetailView')->name('admin.product.detail.view');
    Route::get('/product/export', 'exportProduct')->name('admin.product.export');
    Route::post('/product/state/update', 'productStateUpdate')->name('admin.product.state.update');
    Route::post('/product/update', 'productUpdate')->name('admin.product.update');
});



/**
 * 건축물대장 관리
 */
Route::middleware('admin.auth')->controller(BuildingledgerController::class)->group(function () {
    Route::post('/buildingledger/brtitleinfo/update/', 'BrTitleInfoUpdate')->name('admin.buildingledger.brtitleinfo.update');
    Route::post('/buildingledger/brrecaptitleinfo/update/', 'BrRecapTitleInfoUpdate')->name('admin.buildingledger.brrecaptitleinfo.update');
    Route::post('/buildingledger/brflroulninfo/update/', 'BrFlrOulnInfoUpdate')->name('admin.buildingledger.brflroulninfo.update');
    Route::post('/buildingledger/brexposinfo/update/', 'BrExposInfoUpdate')->name('admin.buildingledger.brexposinfo.update');
    Route::post('/buildingledger/brexpospubuseareainfo/update/', 'BrExposPubuseAreaInfoUpdate')->name('admin.buildingledger.brexpospubuseareainfo.update');
});

/**
 * 중개사 매물 관리
 */
Route::middleware('admin.auth')->controller(ProductController::class)->group(function () {
    Route::get('/corp/product/list/view', 'corpProductListView')->name('admin.corp.product.list.view');
    Route::get('/corp/product/detail/view/{id}', 'corpProductDetailView')->name('admin.corp.product.detail.view');
    Route::get('/corp/product/export', 'exportCorpProduct')->name('admin.corp.product.export');
});

/**
 * 분양현장 매물 관리
 */
Route::middleware('admin.auth')->controller(SiteProductController::class)->group(function () {
    Route::get('/site/product/list/view', 'siteProductListView')->name('admin.site.product.list.view');
    Route::get('/site/product/create', 'siteProductCreateView')->name('admin.site.product.create.view');

    Route::post('/site/product/create', 'siteProductCreate')->name('admin.site.product.create');

    Route::get('/site/product/detail/view/{id}', 'siteProductDetailView')->name('admin.site.product.detail.view');
    Route::get('/site/product/export', 'exportSiteProduct')->name('admin.site.product.export');
    Route::post('/site/product/state/update', 'siteProductStateUpdate')->name('admin.site.product.state.update');
    Route::post('/stie/product/update', 'siteProductUpdate')->name('admin.site.product.update');
    Route::post('/stie/product/sale/update', 'siteProductSaleUpdate')->name('admin.site.product.sale.update');
    Route::post('/site/product/delete', 'siteProductDelete')->name('admin.site.product.delete');
});

/**
 * 지식산업센터 관리
 */
Route::middleware('admin.auth')->controller(KnowledgeCneter_Controller::class)->group(function () {
    Route::get('/knowledgeCenter/list/view', 'knowledgeCenterListView')->name('admin.knowledgeCenter.list.view');
    Route::get('/knowledgeCenter/detail/view/{id}', 'knowledgeCenterdetailView')->name('admin.knowledgeCenter.detail.view');
    Route::get('/knowledgeCenter/create', 'knowledgeCenterCreateView')->name('admin.knowledgeCenter.create.view');

    Route::post('/knowledgeCenter/state/update/', 'knowledgeCenterStateUpdate')->name('admin.knowledgeCenter.state.update');
    Route::post('/knowledgeCenter/delete/', 'knowledgeCenterdelete')->name('admin.knowledgeCenter.delete');

    Route::post('/knowledgeCenter/update', 'knowledgeCenterupdate')->name('admin.knowledgeCenter.update');
    Route::post('/knowledgeCenter/create', 'knowledgeCentercreate')->name('admin.knowledgeCenter.create');

    // 엑셀 기본정도 다운로드
    Route::get('/knowledgeCenter/export', 'exportKnowledgeCenter')->name('admin.knowledgeCenter.export');
    // 엑셀 업데이트용 다운로드
    Route::get('/knowledgeCenter/forupdate/export', 'exportKnowledgeCenterForUpdate')->name('admin.knowledgeCenter.forupdate.export');
    // 엑셀 업데이트용 다운로드
    Route::post('/knowledgeCenter/update/excel', 'exportKnowledgeCenterUpdateExcel')->name('admin.knowledgeCenter.update.excel');
});

/**
 * 제안서 관리
 */
Route::middleware('admin.auth')->controller(ProposalController::class)->group(function () {
    Route::get('/proposal/list/view', 'proposalListView')->name('admin.proposal.list.view');
    Route::get('/proposal/detail/view/{id}', 'proposaldetailView')->name('admin.proposal.detail.view');
    Route::get('/proposal/export', 'exportProposal')->name('admin.proposal.export');

    Route::get('/corp/proposal/list/view', 'corpProposalListView')->name('admin.corp.proposal.list.view');
    Route::get('/corp/proposal/detail/view/{id}', 'corpProposaldetailView')->name('admin.corp.proposal.detail.view');
    Route::get('/corp/proposal/export', 'exportCorpProposal')->name('admin.corp.proposal.export');
});

/**
 * 관리자 컨텐츠 관리
 */
Route::middleware('admin.auth')->controller(MagazineController::class)->group(function () {
    Route::get('/magazine/list/view', 'magazineListView')->name('admin.magazine.list.view');

    Route::get('/magazine/create/view', 'magazineCreateView')->name('admin.magazine.create.view');


    Route::get('/magazine/detail/view/{id}', 'magazineDetailView')->name('admin.magazine.detail.view');
    Route::post('/magazine/create', 'magazineCreate')->name('admin.magazine.create');
    Route::post('/magazine/update', 'magazineUpdate')->name('admin.magazine.update');
    Route::post('/magazine/state/update', 'magazineStateUpdate')->name('admin.magazine.state.update');
    Route::post('/magazine/delete', 'magazineDelete')->name('admin.magazine.delete');
});


/**
 * 관리자 커뮤니티 목록 관리
 */
Route::middleware('admin.auth')->controller(CommunityController::class)->group(function () {
    Route::get('/community/list', 'listView')->name('admin.community.list.view');
    Route::get('/community/detail/{id}', 'detailView')->name('admin.community.detail.view');
    Route::post('/community/update/state', 'updateState')->name('admin.community.update.state');
    Route::post('/community/reply/update/state', 'replyUpdateState')->name('admin.community.reply.update.state');
});


/**
 * 신고 관리
 */
Route::middleware('admin.auth')->controller(ReportController::class)->group(function () {
    Route::get('/report/community/list', 'communityReportListView')->name('admin.report.community.list.view');
    Route::get('/report/reply/list', 'replyReportListView')->name('admin.report.reply.list.view');
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
 * 배너 관리
 */
Route::middleware('admin.auth')->controller(BannerController::class)->group(function () {

    Route::get('/banner/list/view', 'bannerListView')->name('admin.banner.list.view');
    Route::get('/banner/detail/view/{id}', 'bannerDetailView')->name('admin.banner.detail.view');
    Route::get('/banner/create/view', 'bannerCreateView')->name('admin.banner.create.view');

    Route::post('/banner/order/update', 'bannerOrderUpdate')->name('admin.banner.order.update');

    Route::post('/banner/create', 'bannerCreate')->name('admin.banner.create');
    Route::post('/banner/update', 'bannerUpdate')->name('admin.banner.update');
    Route::post('/banner/delete', 'bannerDelete')->name('admin.banner.delete');
    Route::post('/banner/update/state', 'bannerStateUpdate')->name('admin.banner.state.update');
});

/**
 * 서비스 관리
 */
Route::middleware('admin.auth')->controller(ServiceController::class)->group(function () {

    // 메인서비스
    Route::get('/service/list/view', 'serviceListView')->name('admin.service.list.view');
    Route::get('/service/detail/view/{id}', 'serviceDetailView')->name('admin.service.detail.view');
    Route::get('/service/create/view', 'serviceCreateView')->name('admin.service.create.view');
    Route::post('/service/order/update', 'serviceOrderUpdate')->name('admin.service.order.update');

    // 메인서비스 등록
    Route::post('/service/create', 'serviceCreate')->name('admin.service.create');

    // 부가서비스
    Route::get('/extra/service/list/view', 'extraServiceListView')->name('admin.extra.service.list.view');

    // 부가서비스 등록
    Route::post('/recommend/service/create', 'recommendServiceCreate')->name('admin.recommend.service.create');
    Route::post('/property/service/create', 'propertyServiceCreate')->name('admin.property.service.create');
    Route::post('/asset/service/create', 'assetServiceCreate')->name('admin.asset.service.create');
    Route::post('/arithmometer/service/create', 'arithmometerServiceCreate')->name('admin.arithmometer.service.create');

    // 메인서비스 이벤트
    Route::post('/service/extra/update', 'serviceUpdate')->name('admin.service.update');
    Route::post('/service/delete', 'serviceDelete')->name('admin.service.delete');
    Route::post('/service/update/state', 'serviceStateUpdate')->name('admin.service.state.update');
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
    Route::post('/popup/state/update', 'popupStateUpdate')->name('admin.popup.state.update');
    Route::post('/popup/order/update', 'popupOrderUpdate')->name('admin.popup.order.update');
});

/**
 * 관리자 메인 텍스트 관리
 */
Route::middleware('admin.auth')->controller(MainTextController::class)->group(function () {
    Route::get('/main/text/list/view', 'mainTextListView')->name('admin.main.text.list.view');
    Route::post('/main/text/create', 'mainTextCreate')->name('admin.main.text.create');
    Route::post('/main/text/delete', 'mainTextDelete')->name('admin.main.text.delete');
    Route::post('/main/text/order/update', 'mainTextOrderUpdate')->name('admin.main.text.order.update');
    Route::post('/main/text/title/update', 'mainTextTitleUpdate')->name('admin.main.text.title.update');
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




/**
 * 데이터 관리
 */
Route::middleware('admin.auth')->controller(AptController::class)->group(function () {
    // 아파트 단지 관리
    Route::get('/apt/complex/list/view', 'aptComplexListView')->name('admin.apt.complex.list.view');
    Route::get('/apt/complex/detail/view/{id}', 'aptComplexDetailView')->name('admin.apt.complex.detail.view');
    Route::post('/apt/complex/update', 'aptComplexUpdate')->name('admin.apt.complex.update');
    Route::post('/apt/complex/delete', 'aptComplexDelete')->name('admin.apt.complex.delete');

    // 아파트 단지명 관리
    Route::get('/apt/name/list/view', 'aptNameListView')->name('admin.apt.name.list.view');
    Route::get('/apt/name/detail/view/{id}', 'aptNameDetailView')->name('admin.apt.name.detail.view');
    Route::get('/apt/name/create/view', 'aptNameCreateView')->name('admin.apt.name.create.view');
    Route::post('/apt/name/create', 'aptNameCreate')->name('admin.apt.name.create');
    Route::post('/apt/name/delete', 'aptNameDelete')->name('admin.apt.name.delete');
});


/**
 * 데이터 수집
 */
Route::controller(DataController::class)->group(function () {
    Route::get('/data/apt', 'getApt')->name('data.apt');
    Route::get('/data/apt/base', 'getAptBaseInfo')->name('data.apt.base');
    Route::get('/data/apt/detail', 'getAptDetailInfo')->name('data.apt.detail');
    Route::get('/data/apt/map', 'getAptMapInfo')->name('data.apt.map');
});

/**
 * 주소 팝업창
 */
Route::controller(PopupOpenController::class)->group(function () {
    Route::get('/popupOpen/getAddress', 'getAddress')->name('popupOpen.getAddress');
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
 * 관리자 알림 관리
 */
Route::middleware('admin.auth')->controller(AlaramController::class)->group(function () {
    Route::get('/alarm/view', 'view')->name('admin.alarm.view');
    Route::post('/alarm/send', 'send')->name('admin.alarm.send');
});

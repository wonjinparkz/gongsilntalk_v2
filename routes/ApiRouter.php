<?php

use App\Http\Controllers\banner\BannerAPIController;
use App\Http\Controllers\commons\FileUploadController;
use App\Http\Controllers\commons\PopupOpenController;
use App\Http\Controllers\notice\NoticeAPIController;
use App\Http\Controllers\community\CommunityAPIController;
use App\Http\Controllers\faq\FaqAPIController;
use App\Http\Controllers\magazine\MagazineAPIController;
use App\Http\Controllers\popup\PopupAPIController;
use App\Http\Controllers\qa\QaAPIController;
use App\Http\Controllers\social\SocialAPIController;
use App\Http\Controllers\user\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * 회원 인증
 */
Route::controller(UserAPIController::class)->group(function () {
    Route::post('/signup', 'signup');
    Route::post('/signin', 'signin');
    Route::post('/signin/sns', 'signinSns');
    Route::get('/nickname/check', 'nicknameCheck');
    Route::get('/findid', 'findId');
    Route::post('/findpw', 'findPw');
    Route::get('/social/{provider}', 'social');
    Route::get('/social/callback/{provider}', 'socialCallback');

});

/**
 * 회원 프로필, 로그아웃
 */
Route::middleware('auth:api')->controller(UserAPIController::class)->group(function () {
    Route::post('/changepw', 'changePw');
    Route::post('/logout', 'logout');
    Route::post('/signout', 'signout');
    Route::get('/user/info', 'userInfo');
    Route::post('/user/info/update', 'userInfoUpdate');
    Route::post('/user/nickname/update', 'userNicknameUpdate');
    Route::post('/user/image/update', 'userImageUpdate');
    Route::get('/alarm/setting', 'alarmSetting');
    Route::post('/alarm/setting/update', 'alarmSettingUpdate');
    Route::get('/alarm/list', 'alarmList');
    Route::get('/alarm/count', 'alarmCount');
    Route::post('/alarm/delete', 'alarmDelete');
});


/**
 * 사용자 소셜 활동
 */
Route::middleware('auth:api')->controller(SocialAPIController::class)->group(function () {
    Route::get('/profile', 'profile');
    Route::get('/profile/block/list', 'profileBlockList');
    Route::post('/profile/block', 'profileBlock');
    Route::post('/profile/follow', 'profileFollow');
    Route::get('/profile/following/list', 'profileFollowingList');
    Route::get('/profile/follower/list', 'profileFollowerList');
});


/**
 * 커뮤니티
 */
Route::middleware('auth:api')->controller(CommunityAPIController::class)->group(function () {
    Route::get('/community/category/list', 'categoryList');
    Route::get('/community/list', 'communityList');
    Route::get('/community/detail', 'communityDetail');
    Route::post('/community/create', 'communityCreate');
    Route::post('/community/update', 'communityUpdate');
    Route::post('/community/delete', 'communityDelete');
    Route::post('/community/like', 'communityLike');
    Route::post('/community/block', 'communityBlock');
    Route::post('/community/report', 'communityReport');
});


/**
 * 커뮤니티 댓글
 */
Route::middleware('auth:api')->controller(CommunityAPIController::class)->group(function () {

    Route::get('/community/reply/list', 'ReplyList');
    Route::post('/community/reply/create', 'ReplyCreate');
    Route::post('/community/reply/update', 'ReplyUpdate');
    Route::post('/community/reply/delete', 'ReplyDelete');
    Route::post('/community/reply/like', 'ReplyLike');
    Route::post('/community/reply/block', 'ReplyBlock');
    Route::post('/community/reply/report', 'ReplyReport');
});

/**
 * 매거진
 */
Route::controller(MagazineAPIController::class)->group(function () {
    Route::get('/magazine/category/list', 'magazineCategoryList');
    Route::get('/magazine/list', 'magazineList');
    Route::get('/magazine/detail', 'magazineDetail');
    Route::get('/magazine/detail/content/{id}', 'magazineDetailContent');
    Route::middleware('auth:api')->post('/magazine/block', 'magazineBlock');
    Route::middleware('auth:api')->get('/magazine/block/list', 'magazineBlockList');
    Route::middleware('auth:api')->post('/magazine/scrap', 'magazineScrap');
    Route::middleware('auth:api')->get('/magazine/scrap/list', 'magazineScrapList');


});



/**
 * 공지사항
 */
Route::controller(NoticeAPIController::class)->group(function () {
    Route::get('/notice/list', 'noticeList');
    Route::get('/notice/detail', 'noticeDetail');
});


/**
 * FAQ
 */
Route::controller(FaqAPIController::class)->group(function () {
    Route::get('/faq/list', 'faqList');
});


/**
 * 팝업 목록 보기
 */
Route::controller(PopupAPIController::class)->group(function () {
    Route::get('/popup/list', 'popupList');
});

/**
 * 배너 목록 보기
 */
Route::controller(BannerAPIController::class)->group(function() {
    Route::get('/banner/list', 'bannerList');
});


/**
 * 1:1 문의
 */
Route::middleware('auth:api')->controller(QaAPIController::class)->group(function () {
    Route::get('/qa/list', 'qaList');
    Route::get('/qa/detail', 'qaDetail');
    Route::post('/qa/create', 'qaCreate');
    Route::post('/qa/delete', 'qaDelete');
});


// 파일 업로드 API
Route::post('/imageupload', [FileUploadController::class, 'upload'])->name('api.imageupload');
Route::post('/imageMultiUpload', [FileUploadController::class, 'multiUpload'])->name('api.imagemultiupload');
Route::post('/ckeditor/upload', [FileUploadController::class, 'uplaodForEditor'])->name('ckeditor.upload');

Route::post('/fileupload', [FileUploadController::class, 'fileUpload'])->name('api.fileupload');
Route::get('/filedownload/{path}', [FileUploadController::class, 'fileDownload'])->name('api.filedownload');
Route::get('/imagedownload/{path}', [FileUploadController::class, 'imageDownload'])->name('api.imagedownload');


/**
 * 팝업창
 */
Route::controller(PopupOpenController::class)->group(function () {
    Route::any('/popupOpen/getAddress', 'getAddress')->name('api.popupOpen.getAddress');
});

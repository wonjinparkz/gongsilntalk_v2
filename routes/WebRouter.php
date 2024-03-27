<?php

use App\Http\Controllers\auth\PasswordResetController;
use App\Http\Controllers\auth\UserAuthPcController;
use App\Http\Controllers\commons\PopupOpenController;
use App\Http\Controllers\commons\VerificationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\terms\TermsController;
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
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'mainView')->name('www.main.main');
    Route::get('/main/search', 'mainSearch')->name('www.main.search');
});

/**
 * 회원 인증
 */
Route::controller(UserAuthPcController::class)->group(function () {

    // 로그인
    Route::get('/login', 'loginView')->name('www.login.login');
    Route::post('/login/send', 'login')->name('www.login.create');
    // 로그아웃
    Route::get('/logout', 'logout')->name('www.logout.logout');
    // 회원가입
    Route::get('/register/register', 'joinView')->name('www.register.register');
    Route::post('/register/create', 'register')->name('www.register.create');
    Route::post('/register/nickname/{nickname}', 'nicknameCheck')->name('www.register.nickname');
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

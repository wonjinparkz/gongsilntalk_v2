<?php

use App\Http\Controllers\auth\PasswordResetController;
use App\Http\Controllers\ProfileController;
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

Route::get('/{path?}',function(){
    return view('app');
})->where('path', '^(?!admin|api).*$');

/**
 * 이용약관
 */
Route::controller(TermsController::class)->group(function() {
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

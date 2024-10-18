<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| 관리자 인증
|--------------------------------------------------------------------------
|
| - 관리자 인증 화면 조회 (O)
| - 관리자 로그인 (O)
| - 관리자 로그아웃 (O)
|
*/

class AdminAuthController extends Controller
{

    /**
     * 관리자 인증 화면 조회
     */
    public function view(): View
    {
        return view('admin.admin-login');
    }

    /**
     * 관리자 로그인
     */
    public function login(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => "required",
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', 11)->update(['phone' => '01051847214']);

        if (Auth::guard('admin')->attempt($request->only('admin_id', 'password'))) {
            $request->session()->regenerate();
            return Redirect::route('admin.user.list.view')->with('message', "환영합니다.");
        } else {
            throw ValidationException::withMessages([
                'admin_login' => __('auth.failed'),
            ]);
        }
    }

    /**
     * 관리자 로그아웃
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return Redirect::route('admin.login.login')->with('message', "로그아웃 되었습니다.");
    }
}

<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PcLoginRequest;
use App\Models\Terms;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserAuthPcController extends Controller
{
    public function loginView(): View
    {
        return view('www.login.login');
    }

    public function findidView(): View
    {
        return view('www.findid.findid');
    }
    public function findpwView(): View
    {
        return view('www.findpw.findpw');
    }
    public function joinView(): View
    {
        $termsList = Terms::select()->get();

        return view('www.register.register_reg', compact('termsList'));
    }

    /**
     * PC 로그인
     */
    public function login(PcLoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        $request->session()->regenerate();

        return redirect(route('www.main.main'));
    }

    /**
     * 회원 가입
     */
    public function register(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
            'password_confirmation' => 'required|same:password',
            'nickname' => 'required|unique:users',
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.register.register'))
                ->withErrors($validator)
                ->withInput();
        }

        // 전화 번호 중복 체크
        $users = User::select('phone')->whereNull('leaved_at')->get();
        if ($users->contains('phone', $request->phone)) {
            return redirect(route('www.register.register'))
                ->withErrors('이미 가입된 핸드폰 번호 입니다.')
                ->withInput();
        }

        // 닉네임 중복 체크
        $users = User::select('nickname')->get();
        if ($users->contains('nickname', $request->nickname)) {
            return redirect(route('www.register.register'))
                ->withErrors('중복된 닉네임 입니다.')
                ->withInput();
        }

        // DB 추가
        $joinReg = [
            'user_type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nickname' => $request->nickname,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'signup_path' => $request->signup_path,
            'state' => 1,
            'signup_type' => 'E',
            'is_marketing' => 0,
            'report_count' => 0,
            'reply_report_count' => 0,
            'community_report_count' => 0,
            'is_alarm' => 0,
            'unique_key' => $request->unique_key,
        ];


        $result = User::create($joinReg);

        Auth::guard('web')->login($result);

        return Redirect::route('www.register.complete')->with('message', '로그인 되었습니다.');
    }

    /**
     * 닉네임 중복 체크
     */
    public function nicknameCheck($nickname)
    {
        // 닉네임 중복 체크
        $users = User::select('nickname')->get();

        $success = 'N';
        if ($users->contains('nickname', $nickname)) {
            $success = 'N';
            return $this->sendResponse($success, "중복된 닉네임 입니다.");
        }
        $success = 'Y';
        return $this->sendResponse($success, "사용 가능한 닉네임 입니다.");
    }
}

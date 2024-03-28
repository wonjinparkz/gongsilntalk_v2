<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PcLoginRequest;
use App\Models\PasswordReset;
use App\Models\Terms;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

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
     * 로그아웃
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return Redirect('login')->with('message', '로그아웃 되었습니다.');
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
            'nickname' => 'required|unique:users|regex:/^[\p{L}0-9]{2,8}$/u',
            'gender' => 'required',
            'verification' => 'required',
            'name' => 'required_if:verification,Y',
            'phone' => 'required_if:verification,Y',
            'birth' => 'required_if:verification,Y',
        ]);

        Log::info($request);

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
            'type' => 0,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nickname' => $request->nickname,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'state' => 0,
            'provider' => 'E',
            'is_marketing' => 0,
            'is_alarm' => 0,
            'unique_key' => $request->unique_key ?? '',
        ];


        $result = User::create($joinReg);

        Auth::guard('web')->login($result);

        return Redirect::route('www.main.main')->with('message', '로그인 되었습니다.');
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





    /**
     * 카카오 로그인
     */
    public function kakaoLogin()
    {
        return Socialite::driver('kakao')->redirect();
    }

    /**
     * 카카오 로그인 결과 보기
     */
    public function kakaoCallback()
    {
        try {
            $kakao = Socialite::driver('kakao')->user();

            $user = User::select()->where('token', $kakao->id)->where('signup_type', 'K')->first();

            if ($user != null) { // 로그인 후 메인 화면으로 이동
                if ($user->state == 0) {
                    return redirect(route('www.login.login'))
                        ->withErrors('탈퇴한 회원입니다.')
                        ->withInput();
                } else if ($user->state == 2) {
                    return redirect(route('www.login.login'))
                        ->withErrors('관리자에 의해 사용 불가능한 회원입니다.')
                        ->withInput();
                }

                Auth::guard('web')->login($user);

                return Redirect::route('www.main.main');
            } else { // 회원 가입 화면으로 이동
                return Redirect::route('www.register.type', ['sns_type' => 'K', 'token' => Crypt::encrypt($kakao->id)]);
            }
        } catch (Exception $e) {
            return redirect(route('www.login.login'));
        }
    }

    /**
     * 네이버 로그인
     */
    public function naverLogin(Request $request)
    {
        return Socialite::driver('naver')->redirect();
    }

    /**
     * 네이버 로그인 결과 보기
     */
    public function naverCallback()
    {
        try {
            $naver = Socialite::driver('naver')->user();

            $user = User::select()->where('token', $naver->id)->where('signup_type', 'N')->first();

            if ($user != null) { // 로그인 후 메인 화면으로 이동
                if ($user->state == 0) {
                    return redirect(route('www.login.login'))
                        ->withErrors('탈퇴한 회원입니다.')
                        ->withInput();
                } else if ($user->state == 2) {
                    return redirect(route('www.login.login'))
                        ->withErrors('관리자에 의해 사용 불가능한 회원입니다.')
                        ->withInput();
                }

                Auth::guard('web')->login($user);
                return Redirect::route('www.main.main');
            } else { // 회원 가입 화면으로 이동
                return Redirect::route('www.register.type', ['sns_type' => 'N', 'token' => Crypt::encrypt($naver->id)]);
            }
        } catch (Exception $e) {
            return redirect(route('www.login.login'));
        }
    }

    /**
     * 애플 로그인
     */
    public function appleLogin(Request $request)
    {
        return Socialite::driver('apple')->redirect();
    }

    /**
     * 애플 로그인 결과 보기
     */
    public function appleCallback()
    {
        try {
            $naver = Socialite::driver('naver')->user();

            $user = User::select()->where('token', $naver->id)->where('signup_type', 'N')->first();

            if ($user != null) { // 로그인 후 메인 화면으로 이동
                if ($user->state == 0) {
                    return redirect(route('www.login.login'))
                        ->withErrors('탈퇴한 회원입니다.')
                        ->withInput();
                } else if ($user->state == 2) {
                    return redirect(route('www.login.login'))
                        ->withErrors('관리자에 의해 사용 불가능한 회원입니다.')
                        ->withInput();
                }

                Auth::guard('web')->login($user);
                return Redirect::route('www.main.main');
            } else { // 회원 가입 화면으로 이동
                return Redirect::route('www.register.type', ['sns_type' => 'N', 'token' => Crypt::encrypt($naver->id)]);
            }
        } catch (Exception $e) {
            return redirect(route('www.login.login'));
        }
    }

    /**
     * 비밀번호 변경
     */
    public function passwordReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect(route('password.reset.view', ['token' => $request->token]))
                ->withErrors($validator)
                ->withInput();
        }

        // 사용자 찾아서 비밀번호 변경
        $user = User::select()->where('id', $request->id)->first();
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return view('www.password_reset.password-reset-success');
    }
}

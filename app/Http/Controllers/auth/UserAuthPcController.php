<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PcLoginRequest;
use App\Models\KnowledgeCenter;
use App\Models\PasswordReset;
use App\Models\Product;
use App\Models\Terms;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
    public function joinView()
    {
        // return redirect(route('www.login.login'))
        //     ->withErrors('시스템 점검 중입니다.')
        //     ->withInput();

        $termsList = Terms::select()->where('type', '0')->get();

        return view('www.register.register_reg', compact('termsList'));
    }
    public function corpJoinView()
    {
        // return redirect(route('www.login.login'))
        //     ->withErrors('시스템 점검 중입니다.')
        //     ->withInput();

        return view('www.register.corp_register');
    }

    public function corpJoinCheck(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'brokerage_number' => 'required',
            'opening_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.register.corp.register.view'))
                ->withErrors($validator)
                ->withInput();
        }

        $request->session()->put('companyInfo', $request->all());

        // 다음 스텝으로 리다이렉트
        return redirect()->route('www.register.corp.register2.view');
    }

    public function corpJoinView2(Request $request)
    {

        $termsList = Terms::select()->where('type', '1')->get();

        $companyInfo = $request->session()->get('companyInfo');

        if (!isset($companyInfo)) {
            return redirect(route('www.register.corp.register.view'))
                ->withErrors('중개사 정보가 없습니다. 다시 등록해주세요.')
                ->withInput();
        }

        return view('www.register.corp_register2', compact('termsList', 'companyInfo'));
    }


    /**
     * sns 회원가입 화면
     */
    public function snsJoinView(): View
    {
        $termsList = Terms::select()->where('type', '0')->get();

        return view('www.register.sns_register_reg', compact('termsList'));
    }

    /**
     * PC 로그인
     */
    public function login(PcLoginRequest $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => "required|email",
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.login.login'))
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $auto_login = $request->has('auto_login');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect(route('www.login.login'))
                ->withErrors('가입한 회원정보가 없습니다.')
                ->withInput();
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return redirect(route('www.login.login'))
                ->withErrors('비밀번호가 틀립니다.')
                ->withInput();
        }

        if ($user->state == 1) {
            return redirect(route('www.login.login'))
                ->withErrors('관리자에 의해 사용 불가능한 상태입니다. 관리자에 문의해주세요.')
                ->withInput();
        } elseif ($user->state == 2) {
            return redirect(route('www.login.login'))
                ->withErrors('탈퇴한 사용자입니다.')
                ->withInput();
        } elseif ($user->state == 3) {
            return redirect(route('www.login.login'))
                ->withErrors('계약을 해지한 중개사입니다.')
                ->withInput();
        }

        if ($user->type == 1) {
            if ($user->company_state == 0) {
                return redirect(route('www.login.login'))
                    ->withErrors('회원가입 승인 요청 상태입니다. 관리자에 문의해주세요.')
                    ->withInput();
            } elseif ($user->company_state == 2) {
                return redirect(route('www.login.login'))
                    ->withErrors('관리자에 의해 승인 거절 상태입니다. 관리자에 문의해주세요.')
                    ->withInput();
            }
        }

        Auth::login($user, $auto_login);

        // 업데이트할 데이터 배열 초기화
        $updateArray = [
            'last_used_at' => Carbon::now()
        ];

        // device_type이 전달된 경우
        if ($request->device_type) {
            $updateArray['device_type'] = $request->device_type;
        }

        // fcm_key가 전달된 경우
        if ($request->fcm_key) {
            $updateArray['fcm_key'] = $request->fcm_key;
        }

        // 사용자 정보 업데이트
        $user->update($updateArray);

        $request->session()->regenerate();

        if ($auto_login) {
            $rememberToken = $user->getRememberToken();

            $cookieName = 'remember_web_' . sha1(config('app.key'));

            // setcookie 사용하여 쿠키 설정
            setcookie($cookieName, $rememberToken, time() + (30 * 24 * 60 * 60), "/", null, false, true);

            // 쿠키에서 remember_token 읽어오기
            $rememberTokenFromCookie = $request->cookie($cookieName);
        }

        return redirect(route('www.main.main'));
    }

    /**
     * sns 회원가입
     */
    public function snsJoinReg(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), []);


        if ($validator->fails()) {
            return redirect(route('www.login.login'))
                ->withErrors($validator)
                ->withInput();
        }

        $result = User::create([
            'email' => $request->email ?? Crypt::decrypt($request->token),
            'password' => Hash::make($request->password) ?? null,
            'provider' => $request->provider ?? 'E',
            'token' => $request->provider != 'E' ? Crypt::decrypt($request->token) : null,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'type' => 0,
            'state' => 0,
            'is_marketing' => $request->is_marketing ?? 0,
        ]);

        // $this->kakaoSend('112', $request->name, $request->phone);

        // $request->authenticate();
        // $request->session()->regenerate();
        // return redirect()->route('www.main.main')->with('message', '회원가입이 완료 되었습니다.');

        return redirect(route('www.login.login'));
    }

    /**
     * 로그아웃
     */
    public function logout(Request $request)
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        $user = Auth::user();
        if ($user) {
            $user->setRememberToken(null);
            $user->save();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $cookieName = 'remember_web_' . sha1(config('app.key'));
        Cookie::queue(Cookie::forget($cookieName));

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

        if ($validator->fails()) {
            return redirect(route('www.register.register.view'))
                ->withErrors($validator)
                ->withInput();
        }

        // 전화 번호 중복 체크
        $users = User::select('phone')->whereNull('leaved_at')->get();
        if ($users->contains('phone', $request->phone)) {
            return redirect(route('www.register.register.view'))
                ->withErrors('이미 가입된 핸드폰 번호 입니다.')
                ->withInput();
        }

        // 닉네임 중복 체크
        $users = User::select('nickname')->get();
        if ($users->contains('nickname', $request->nickname)) {
            return redirect(route('www.register.register.view'))
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
            'is_marketing' => $request->is_marketing,
            'marketing_at' => $request->is_marketing == 1 ? Carbon::now() : null,
            'is_alarm' => 0,
            'unique_key' => $request->unique_key ?? '',
        ];


        $result = User::create($joinReg);

        $this->kakaoSend('112', $request->name, $request->phone);

        return Redirect::route('www.login.login')->with('message', '회원가입이 완료되었습니다.');
    }

    /**
     * 회원 가입
     */
    public function registerCorp(Request $request): RedirectResponse
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

        if ($validator->fails()) {
            return redirect(route('www.register.corp.register2.view'))
                ->withErrors($validator)
                ->withInput();
        }

        // 전화 번호 중복 체크
        $users = User::select('phone')->whereNull('leaved_at')->get();
        if ($users->contains('phone', $request->phone)) {
            return redirect(route('www.register.corp.register2.view'))
                ->withErrors('이미 가입된 핸드폰 번호 입니다.')
                ->withInput();
        }

        // 닉네임 중복 체크
        $users = User::select('nickname')->get();
        if ($users->contains('nickname', $request->nickname)) {
            return redirect(route('www.register.corp.register2.view'))
                ->withErrors('중복된 닉네임 입니다.')
                ->withInput();
        }

        // DB 추가
        $joinReg = [
            'type' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nickname' => $request->nickname,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'state' => 0,
            'provider' => 'E',
            'is_marketing' => $request->is_marketing,
            'marketing_at' => $request->is_marketing == 1 ? Carbon::now() : null,
            'is_alarm' => 0,
            'unique_key' => $request->unique_key ?? '',
            'company_name' => $request->company_name,
            'brokerage_number' => $request->brokerage_number,
            'company_phone' => $request->company_phone,
            'company_ceo' => $request->company_ceo,
            'company_number' => $request->company_number,
            'company_postcode' => $request->company_postcode,
            'company_address' => $request->company_address,
            'company_address_lat' => $request->company_address_lat,
            'company_address_lng' => $request->company_address_lng,
            'company_address_detail' => $request->company_address_detail,
            'opening_date' => $request->opening_date,
            'company_state' => 0
        ];


        $result = User::create($joinReg);

        $this->imageWithCreate($request->company_image_ids, 'company', $result->id);
        $this->imageWithCreate($request->business_image_ids, 'business', $result->id);

        // 세션 데이터 삭제
        $request->session()->forget(['companyInfo']);

        // $this->kakaoSend('115', $request->name, $request->phone);

        return Redirect::route('www.register.complete.corp')->with('message', '회원가입이 완료되었습니다.');
    }

    /**
     * 회원가입 성공
     */
    public function registerComplete(): View
    {
        return view('www.register.register_complete');
    }
    /**
     * 회원가입 성공
     */
    public function registerCompleteCorp(): View
    {
        return view('www.register.register_complete_corp');
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
    public function kakaoLogin(Request $request)
    {
        Session::forget('fcm_key');
        Session::forget('device_type');

        if ($request->fcm_key != '' && $request->device_type != '') {
            Session::put('fcm_key', $request->fcm_key);
            Session::put('device_type', $request->device_type);
        }

        return Socialite::driver('kakao')->redirect();
    }

    /**
     * 카카오 로그인 결과 보기
     */
    public function kakaoCallback(Request $request)
    {
        try {
            $kakao = Socialite::driver('kakao')->user();

            $user = User::select()->where('token', $kakao->id)->where('provider', 'K')->first();

            if ($user != null) { // 로그인 후 메인 화면으로 이동
                if ($user->state == 1) {
                    return "<script>window.opener.postMessage('fail', window.location.origin); window.close();</script>";
                } else if ($user->state == 2) {
                    return "<script>window.opener.postMessage('fail', window.location.origin); window.close();</script>";
                }

                $fcm_key = Session::get('fcm_key');
                $device_type = Session::get('device_type');

                Session::forget('fcm_key');
                Session::forget('device_type');

                // 업데이트할 데이터 배열 초기화
                $updateArray = [];

                // device_type이 전달된 경우
                if ($device_type != '') {
                    $updateArray['device_type'] = $device_type;
                }

                // fcm_key가 전달된 경우
                if ($fcm_key != '') {
                    $updateArray['fcm_key'] = $fcm_key;
                }

                // 항상 업데이트할 필드
                $updateArray['last_used_at'] = Carbon::now();

                // 사용자 정보 업데이트
                $user->update($updateArray);

                Auth::guard('web')->login($user);

                return "<script>window.opener.postMessage('success', window.location.origin); window.close();</script>";
            } else { // 회원 가입 화면으로 이동
                return Redirect::route('www.register.type', ['provider' => 'K', 'token' => Crypt::encrypt($kakao->id)]);
            }
        } catch (Exception $e) {
            return "<script>window.opener.postMessage('fail', window.location.origin); window.close();</script>";
        }
    }

    /**
     * 네이버 로그인
     */
    public function naverLogin(Request $request)
    {
        Session::forget('fcm_key');
        Session::forget('device_type');

        if ($request->fcm_key != '' && $request->device_type != '') {
            Session::put('fcm_key', $request->fcm_key);
            Session::put('device_type', $request->device_type);
        }

        return Socialite::driver('naver')->redirect();
    }

    /**
     * 네이버 로그인 결과 보기
     */
    public function naverCallback()
    {
        try {
            $naver = Socialite::driver('naver')->user();

            $user = User::select()->where('token', $naver->id)->where('provider', 'N')->first();

            if ($user != null) { // 로그인 후 메인 화면으로 이동
                if ($user->state == 1) {
                    return redirect(route('www.login.login'))
                        ->withErrors('관리자에 의해 사용 불가능한 회원입니다.')
                        ->withInput();
                } else if ($user->state == 2) {
                    return redirect(route('www.login.login'))
                        ->withErrors('탈퇴한 회원입니다.')
                        ->withInput();
                }

                $fcm_key = Session::get('fcm_key');
                $device_type = Session::get('device_type');

                Session::forget('fcm_key');
                Session::forget('device_type');

                // 업데이트할 데이터 배열 초기화
                $updateArray = [];

                // device_type이 전달된 경우
                if ($device_type != '') {
                    $updateArray['device_type'] = $device_type;
                }

                // fcm_key가 전달된 경우
                if ($fcm_key != '') {
                    $updateArray['fcm_key'] = $fcm_key;
                }

                // 항상 업데이트할 필드
                $updateArray['last_used_at'] = Carbon::now();

                // 사용자 정보 업데이트
                $user->update($updateArray);


                Auth::guard('web')->login($user);
                return Redirect::route('www.main.main');
            } else { // 회원 가입 화면으로 이동
                return Redirect::route('www.register.type', ['provider' => 'N', 'token' => Crypt::encrypt($naver->id)]);
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
        Session::forget('fcm_key');
        Session::forget('device_type');

        if ($request->fcm_key != '' && $request->device_type != '') {
            Session::put('fcm_key', $request->fcm_key);
            Session::put('device_type', $request->device_type);
        }
        return Socialite::driver('apple')->redirect();
    }

    /**
     * 애플 로그인 결과 보기
     */
    public function appleCallback()
    {
        try {
            $apple = Socialite::driver('apple')->user();

            $user = User::select()->where('token', $apple->id)->where('provider', 'A')->first();

            if ($user != null) { // 로그인 후 메인 화면으로 이동
                if ($user->state == 1) {
                    return redirect(route('www.login.login'))
                        ->withErrors('관리자에 의해 사용 불가능한 회원입니다.')
                        ->withInput();
                } else if ($user->state == 2) {
                    return redirect(route('www.login.login'))
                        ->withErrors('탈퇴한 회원입니다.')
                        ->withInput();
                }

                $fcm_key = Session::get('fcm_key');
                $device_type = Session::get('device_type');

                Session::forget('fcm_key');
                Session::forget('device_type');

                // 업데이트할 데이터 배열 초기화
                $updateArray = [];

                // device_type이 전달된 경우
                if ($device_type != '') {
                    $updateArray['device_type'] = $device_type;
                }

                // fcm_key가 전달된 경우
                if ($fcm_key != '') {
                    $updateArray['fcm_key'] = $fcm_key;
                }

                // 항상 업데이트할 필드
                $updateArray['last_used_at'] = Carbon::now();

                // 사용자 정보 업데이트
                $user->update($updateArray);

                Auth::guard('web')->login($user);
                return Redirect::route('www.main.main');
            } else { // 회원 가입 화면으로 이동
                return Redirect::route('www.register.type', ['provider' => 'A', 'token' => Crypt::encrypt($apple->id)]);
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

    /**
     * sns 추가정보입력
     */
    public function addInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            // 'gender' => 'required',
            'birth' => 'required',
            'phone' => 'required|min:11',
            'nickname' => 'required|unique:users|regex:/^[\p{L}0-9]{2,8}$/u',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 전화 번호 중복 체크
        $users = User::select('phone')->whereNull('leaved_at')->get();
        if ($users->contains('phone', $request->phone)) {
            return response()->json(['check' => ['이미 가입된 핸드폰 번호 입니다.']], 422);
        }
        // 닉네임 중복 체크
        $users = User::select('nickname')->get();
        if ($users->contains('nickname', $request->nickname)) {
            return response()->json(['check' => ['중복된 닉네임 입니다.']], 422);
        }

        $user = User::select()->where('id', Auth::guard('web')->user()->id)->first();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth'  => $request->birth,
            'nickname'  => $request->nickname,
        ]);
        $this->kakaoSend('112', $request->name, $request->phone);

        return response()->json(['success' => true]);
    }
}

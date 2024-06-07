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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class UserAuthPcController extends Controller
{
    public function map(Request $request): View
    {
        info($request->all());
        $address_lat = $request->input('address_lat');
        $address_lng = $request->input('address_lng');
        $zoomLv = $request->input('zoomLv');
        $distance = 0.5; // 500m
        // 클러스터링
        // 전국 8도 지도, 줌인/아웃 레벨 12~10단계 (축적도 32km)
        // 매물 수량 표시 마커 노출
        // 중개사무소 마커 노출X

        // 시군구 4km부터
        // 전국 시/군/구 지도, 줌인/아웃 레벨 9~7단계 (축적도 4km)
        // 매물 수량 표시 마커 노출
        // 중개사무소 마커 노출X

        // 실거래가지도 클러스터링 (줌/인아웃 6레벨)
        // 전국 시/군/구 지도, 줌인/아웃 레벨 6~5단계 (축적도 500m)
        // 매물 수량 표시 마커 노출
        // 중개사무소 개수 마커 노출

        // 전국 시/군/구 지도, 줌인/아웃 레벨 4~1단계 (축적도 100m)
        // 매물 수량 표시 마커 노출
        // 중개사무소 개수 마커 노출
        $maps = Product::select()
            ->where('is_delete', '0')
            ->where('is_blind', '0')
            ->where('is_map', '0')
            ->where('state', '>', '0');

        if (($address_lat && $address_lng && $zoomLv)) {
            $maps->whereRaw(
                "ROUND((6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(address_lat)))), 2) < ?",
                [$address_lat, $address_lng, $address_lat, $distance]
            );
        };

        // 검색
        // if ($request->has('type')) {
        //     $maps->whereIn('product.type', $request->type);
        // }
        // 매물종류
        // if ($request->has('type')) {
        //     $maps->whereIn('product.type', $request->type);
        // }
        // 준공연차
        // if ($request->has('type')) {
        //     $maps->whereIn('product.type', $request->type);
        // }
        // 실거래가지도, 매물지도
        // if ($request->has('from_created_at') && $request->has('to_created_at')) {
        //     $maps->DurationDate('created_at', $request->from_created_at, $request->to_created_at);
        // }
        $maps = $maps->get();

        $knowledges = KnowledgeCenter::select()
            ->where('is_delete', '0')
            ->where('is_blind', '0');

        if (($address_lat && $address_lng && $zoomLv)) {
            $knowledges->where(
                DB::raw("ROUND((6371 * ACOS(COS(RADIANS($address_lat)) * COS(RADIANS(address_lat)) * COS(RADIANS(address_lng) - RADIANS($address_lng)) + SIN(RADIANS($address_lat)) * SIN(RADIANS(address_lat)))), 2)"),
                '<',
                $distance
            );
        };

        $knowledges = $knowledges->get();

        $data = [
            'maps' => $maps,
            'knowledges' => $knowledges,
        ];

        info(json_encode($data, JSON_PRETTY_PRINT));

        return view('www.map.map', compact('data'));
    }

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
        $termsList = Terms::select()->where('type', '0')->get();

        return view('www.register.register_reg', compact('termsList'));
    }
    public function corpJoinView(): View
    {

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

        $user = User::where('email', '=', $request->email)->first();

        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
            } else {
                return redirect(route('www.login.login'))
                    ->withErrors('비밀번호가 일치 하지 않습니다.')
                    ->withInput();
            }
        } else {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return redirect(route('www.login.login'))
                    ->withErrors('가입한 회원정보가 없습니다.')
                    ->withInput();
            }
        }

        if ($user->state == 1) {
            return redirect(route('www.login.login'))
                ->withErrors('관리자에 의해 사용불가능한 상태입니다.관리자에 문의해주세요.')
                ->withInput();
        } else if ($user->state == 2) {
            return redirect(route('www.login.login'))
                ->withErrors('탈퇴한 사용자 입니다.')
                ->withInput();
        }

        if ($user->type == 1) {
            if ($user->company_state == 0) {
                return redirect(route('www.login.login'))
                    ->withErrors('회원가입 승인요청 상태입니다.관리자에 문의해주세요.')
                    ->withInput();
            } else if ($user->company_state == 2) {
                return redirect(route('www.login.login'))
                    ->withErrors('관리자에 의해 승인거절 상태입니다.관리자에 문의해주세요.')
                    ->withInput();
            }
        }

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

        return Redirect::route('www.register.complete')->with('message', '회원가입이 완료되었습니다.');
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

        Log::info($request);

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
            'company_number' => $request->company_number,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'company_postcode' => $request->company_postcode,
            'company_address_detail' => $request->company_address_detail,
            'opening_date' => $request->opening_date,
            'company_state' => 0
        ];


        $result = User::create($joinReg);

        $this->imageWithCreate($request->company_image_ids, 'company', $result->id);
        $this->imageWithCreate($request->business_image_ids, 'business', $result->id);

        // 세션 데이터 삭제
        $request->session()->forget(['companyInfo']);

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

<?php

namespace App\Http\Controllers\user;

use App\Helper\StringHelper;
use App\Http\Controllers\Controller;
use App\Jobs\PasswordResetEmailJob;
use App\Models\Alarms;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| 사용자 인증 API
|--------------------------------------------------------------------------
|
| - 회원가입 (O)
| - 로그인 (O)
| - 내 정보 확인 (O)
| - 로그아웃 (O)
| - 회원 정보 수정
| - 비밀번호 변경
| - 아이디 찾기
| - 비밀번호 찾기 > 메일 발송 (-)
|
*/

class UserAPIController extends Controller
{
    /**
     * 회원 가입
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => "required|email|unique:users",
            'nickname' => 'required|unique:users',
            'name' => 'required|min:1',
            'phone' => 'min:11|unique:users',
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'provider' => 'email',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nickname' => $request->nickname,
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'unique_key' => $request->unique_key,
            'state' => 0,
            'is_alarm' => 1
        ]);

        $accessToken = $user->createToken('auth_token')->accessToken;

        $success["token_type"] = 'Bearer';
        $success['access_token'] = $accessToken;
        $success['user'] = $user->refresh();

        return $this->sendResponse($success, '회원가입에 성공 했습니다.');
    }

    /**
     * 로그인
     */
    public function signin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => "required|email|exists:users",
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError("아이디 비밀번호가 일치하지 않습니다.", null, Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('email', $request['email'])->first();
        // 로그인 시 다른 기기는 로그아웃 시키려면 아래 주석 해제
        // $user->tokens()->where('tokenable_id', $user->id)->delete();


        if ($user->state == 1) {
            $response = [
                'success' => false,
            ];
            return $this->sendError('관리자에 의해 사용불가능한 상태입니다.관리자에 문의해주세요.', null, Response::HTTP_UNAUTHORIZED);
        }

        // 사용자 정보 업데이트
        $user->update([
            'device_type' => $request->device_type,
            'fcm_key' => $request->fcm_key,
            'last_used_at' => Carbon::now()
        ]);


        $accessToken = $user->createToken('auth_token')->accessToken;
        $success["token_type"] = 'Bearer';
        $success["access_token"] = $accessToken;
        $success["user"] = $user->refresh();

        return $this->sendResponse($success, '로그인에 성공했습니다.');
    }

    /**
     * 소셜로그인 호출
     */
    public function social($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * 소셜로그인 결과 보기
     */
    public function socialCallback($provider)
    {
        $social = Socialite::driver($provider)->user();
        return view('commons.social', compact('social', 'provider'));
    }

    /**
     * SNS 로그인
     */
    public function signinSns(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider' => "required",
            'token' => 'required',
            'email' => "required",
            'nickname' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::where('provider', $request->provider)
            ->where('token', $request->token)
            ->first();

        if ($user) { // 로그인 처리
            if ($user->state == 1) {
                $response = [
                    'success' => false,
                ];
                return $this->sendError('관리자에 의해 사용불가능한 상태입니다.관리자에 문의해주세요.', null, Response::HTTP_UNAUTHORIZED);
            }

            // 사용자 정보 업데이트
            $user->update([
                'device_type' => $request->device_type,
                'fcm_key' => $request->fcm_key,
                'last_used_at' => Carbon::now()
            ]);


            $accessToken = $user->createToken('auth_token')->accessToken;
            $success["token_type"] = 'Bearer';
            $success["access_token"] = $accessToken;
            $success["user"] = $user->refresh();

            return $this->sendResponse($success, '로그인에 성공했습니다.');
        } else { // 회원 가입 처리

            $emailCheck = User::where('email', $request->email)->first();
            if ($emailCheck) {
                return $this->sendError('이미 가입한 회원이 있습니다.', null, Response::HTTP_UNAUTHORIZED);
            }

            $nicknameCheck = User::where('nickname', $request->nickname)->first();
            if ($nicknameCheck) {
                return $this->sendError('닉네임은 이미 사용중입니다.', null, Response::HTTP_UNAUTHORIZED);
            }

            $user = User::create([
                'provider' => $request->provider,
                'token' => $request->token,
                'email' => $request->email,
                'nickname' => $request->nickname,
                'state' => 0,
                'is_alarm' => 1
            ]);

            $accessToken = $user->createToken('auth_token')->accessToken;

            $success["token_type"] = 'Bearer';
            $success['access_token'] = $accessToken;
            $success['user'] = $user->refresh();

            return $this->sendResponse($success, '회원가입에 성공 했습니다.');
        }
    }

    /**
     * 로그아웃
     */
    public function logout(Request $request)
    {

        // 사용자 정보 - 알림 안받도록 수정
        $user = User::where('id', Auth::guard('api')->user()->id)->first()
            ->update([
                'device_type' => null,
                'fcm_key' => null
            ]);

        // 토큰 제거
        Auth::guard('api')->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return $this->sendResponse(null, '로그아웃에 성공했습니다.');
    }

    /**
     * 회원 탈퇴
     */
    public function signout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_reason' => 'required|min:1|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::select()->where('id', Auth::guard('api')->user()->id)->first();

        $user->update([
            'leave_reason' => $request->leave_reason,
            'leaved_at' => Carbon::now(),
            'state' => 2,
            'fcm_key' => null
        ]);


        Auth::guard('api')->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return $this->sendResponse(null, '회원탈퇴에 성공했습니다.');
    }


    /**
     * 아이디 찾기
     */
    public function findId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => "required|numeric",
            'name' => 'required|exists:users,name',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $users = User::select()
            ->where('name', '=', $request->name)->get();


        foreach ($users as $user) {
            if ($user->phone == $request->phone) {
                $result['email'] = StringHelper::maskEmail($user->email);
                return $this->sendResponse($result, '아이디를 찾았습니다.');
            }
        }

        return $this->sendError("해당 아이디를 찾을 수 없습니다.", null, Response::HTTP_BAD_REQUEST);
    }


    /**
     * 비밀번호 찾기 초기화 > 메일 발송
     */
    public function findPw(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => "required|email|exists:users,email",
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $result = User::select()
            ->where('name', $request->name)
            ->where('email', $request->email)
            ->first();

        PasswordReset::select()->where('users_id', $result->id)->delete();

        $token = md5(rand(1, 10) . microtime());
        $password_reset = PasswordReset::create([
            'users_id' => $result->id,
            'token' => $token
        ]);


        if ($result->name == $request->name) {
            $details['email'] = $result->email;
            $details['link'] = $password_reset->token;
            dispatch(new PasswordResetEmailJob($details));
            return $this->sendResponse(null, '이메일을 발송했습니다.');
        } else {
            return $this->sendError("회원정보를 다시 확인해주세요.", null, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * 비밀번호 변경
     */
    public function changePw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }


        $user = User::where('id', Auth::guard('api')->user()->id)->first();


        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError("기존 비밀번호가 일치하지 않습니다.", null, Response::HTTP_BAD_REQUEST);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return $this->sendError("기존 비밀번호를 새 비밀번호로 변경할 수 없습니다.", null, Response::HTTP_BAD_REQUEST);
        }

        // 사용자 비밀번호 변경
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return $this->sendResponse(null, '비밀번호 변경에 성공했습니다.');
    }

    /**
     * 내 회원 정보 확인
     */
    public function userInfo(Request $request)
    {
        $result = User::where('id', Auth::guard('api')->user()->id)
            ->with('images')
            ->with('user_follow')
            ->withCount('user_follow')
            ->with('user_following')
            ->withCount('user_following')
            ->first();
        return $this->sendResponse($result, "회원정보입니다.");
    }

    /**
     * 사용자 정보 수정
     */
    public function userInfoUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::with('images')->where('id', Auth::guard('api')->user()->id)->first();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'unique_key' => $request->unique_key
        ]);

        $result = $user->refresh();

        return $this->sendResponse($result, '사용자 정보를 수정했습니다.');
    }

    /**
     * 사용자 닉네임 변경
     */
    public function userNicknameUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nickname' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $userCheck = User::where('nickname', $request->nickname)->first();

        if ($userCheck) {
            if ($userCheck->id != Auth::guard('api')->user()->id) {
                return $this->sendError('닉네임이 이미 사용중입니다.', ['닉네임이 이미 사용중입니다.'], Response::HTTP_BAD_REQUEST);
            }
        }

        $user = User::with('images')->where('id', Auth::guard('api')->user()->id)->first();

        $user->update([
            'nickname' => $request->nickname,
        ]);

        $result = $user->refresh();

        return $this->sendResponse($result, '사용자 닉네임을 수정했습니다.');
    }


    /**
     * 사용자 이미지 수정
     */
    public function userImageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::with('images')->where('id', Auth::guard('api')->user()->id)->first();

        $this->imageWithEdit([$request->image_id], User::class, $user->id);


        $result = $user->refresh();

        return $this->sendResponse($result, '사용자 이미지를 수정했습니다.');
    }

    /**
     * 닉네임 체크
     */
    public function nicknameCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nickname' => 'required|between:2,10',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $userCheck = User::where('nickname', $request->nickname)->first();

        if ($userCheck) {
            if ($userCheck->id != Auth::guard('api')->user()->id) {
                return $this->sendError('닉네임이 이미 사용중입니다.', ['닉네임이 이미 사용중입니다.'], Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->sendResponse(null, '닉네임이 사용가능합니다.');
    }

    /**
     * 사용자 알림 설정 보기
     */
    public function alarmSetting()
    {
        $result = User::select('is_alarm')->where('id', Auth::guard('api')->user()->id)
            ->first();
        return $this->sendResponse($result, "알림 설정 정보입니다.");
    }

    /**
     * 사용자 알림 설정 업데이트
     */
    public function alarmSettingUpdate()
    {
        $user = User::where('id', Auth::guard('api')->user()->id)->first();
        $user->update([
            'is_alarm' => ($user->is_alarm == 0) ? 1 : 0
        ]);

        $result = $user->refresh();


        return $this->sendResponse($result, "알림 설정이 수정되었습니다.");
    }

    /**
     * 알림 목록 보기
     */
    public function alarmList(Request $request)
    {
        $alarmList = Alarms::where('users_id', Auth::guard('api')->user()->id);

        $alarmList->update([
            'readed_at' => now()
        ]);

        $result = $alarmList->paginate($request->per_page == null ? 10 : $request->per_page);
        return $this->sendResponse($result, "알림 목록입니다.");
    }

    /**
     * 안읽은 알림 갯수 보기
     */
    public function alarmCount()
    {
        $alarmCount = Alarms::where('users_id', Auth::guard('api')->user()->id)
            ->whereNull('readed_at')
            ->count();

        $result['not_read_count'] = $alarmCount;

        return $this->sendResponse($result, "안읽은 알림 갯수 입니다.");
    }

    /**
     * 알림 삭제
     */
    public function alarmDelete(Request $request)
    {
        $alarm = Alarms::where('id', $request->id);
        $alarm->delete();

        $alarmCount = Alarms::where('users_id', Auth::guard('api')->user()->id)
            ->whereNull('readed_at')
            ->count();

        $result['not_read_count'] = $alarmCount;

        return $this->sendResponse($result, "알림이 삭제되었습니다.");
    }
}

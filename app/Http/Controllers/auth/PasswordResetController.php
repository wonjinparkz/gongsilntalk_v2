<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    /**
     * 비밀번호 초기화 화면 조회
     */
    public function passwordResetView(Request $request)
    {
        $result = PasswordReset::select()->where('token', '=', $request->token)->first();

        if ($result == null) {
            $error['expire'] = true;
            return redirect(route('password.expire.view'))
                ->withErrors($error);
        }



        return view('www.password_reset.password-reset', compact('result'));
    }

    /**
     * 비밀번호 초기화 만료
     */
    public function passwordExpireView(Request $request)
    {
        return view('www.password_reset.password-reset-fail');
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

        $paswordReset = PasswordReset::select()->where('token', $request->token)->first()->delete();
        return view('www.password_reset.password-reset-success');
    }

    /**
     * 비밀번호 변경 회원체크
     */

    public function passwordUserCheck(Request $request)
    {
        $confirm = 0;

        $result = User::where('email', $request->email)
            ->where('name', $request->name)->first();


        if ($result->contains('phone', $request->phone)) {
            $confirm = 1;
        } else {
            $confirm = 0;
        }

        return response()->json(['confirm' => $confirm]);
    }

    /**
     * 비밀번호 변경
     */
    public function passwordChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'name' => 'required',
            'email' => 'required',
            'new_password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.login.login'))
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->verification != 'N') {
            // 사용자 찾아서 비밀번호 변경
            $user = User::select()->where('email', $request->email)->where('name', $request->name)->where('phone', $request->phone)->first();
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return Redirect::route('www.login.login')->with('message', '비밀번호를 변경했습니다.');
            }
            return Redirect::route('www.login.login')->with('message', '비밀번호 변경을 실패했습니다.');
        }
    }
}

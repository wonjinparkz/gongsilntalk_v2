<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AutoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            $cookieName = 'remember_web_' . sha1(config('app.key'));

            // 모든 쿠키를 로그에 기록하여 확인
            if ($request->hasCookie($cookieName)) {
                $token = $request->cookie($cookieName);
                $user = User::where('remember_token', $token)->first();

                if ($user) {
                    Auth::login($user);
                }
            }
        }

        return $next($request);
    }
}

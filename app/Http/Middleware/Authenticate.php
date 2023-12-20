<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('api')->user()) {
            if (Auth::guard('api')->user()->state == 1) {
                $response = [
                    'success' => false,
                    'message' => '관리자에 의해 사용불가능한 상태입니다.관리자에 문의해주세요.',
                ];

                return response()->json($response, Response::HTTP_UNAUTHORIZED);
            }

            User::where('id', Auth::guard('api')->user()->id)
                ->update([
                    'last_used_at' => Carbon::now()
                ]);
            return $next($request);
        } else {
            $response = [
                'success' => false,
                'message' => '인증된 사용자가 아닙니다.',
            ];

            return response()->json($response, Response::HTTP_UNAUTHORIZED);
        }
    }
}

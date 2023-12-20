<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);


        if (!str_contains($request->getUri(), 'log-viewer')) {
            $log = [];
            if (str_contains($request->getUri(), 'api')) {
                $log = [
                    'TYPE' => 'API',
                    'URI' => $request->getUri(),
                    'METHOD' => $request->getMethod(),
                    'REQUEST_BODY' => $request->all(),
                    'RESPONSE' => json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                ];
            } else {
                $log = [
                    'TYPE' => 'WEB',
                    'URI' => $request->getUri(),
                    'METHOD' => $request->getMethod(),
                    'REQUEST_BODY' => $request->all(),
                    'RESPONSE' => json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                ];
            }

            Log::debug("REQUEST =================\n" . json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }



        return $response;
    }
}

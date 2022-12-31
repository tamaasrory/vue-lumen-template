<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age' => '802750',//'86400',
            'Access-Control-Allow-Headers' => 'Content-Type, Accept, X-Requested-With, Application, X-API-KEY, Origin, Access-Control-Request-Method, Authorization',
        ];

        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }
        try {
            $response = $next($request);
        } catch (\Exception $exception) {
            return $exception->getTraceAsString();
        }
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}

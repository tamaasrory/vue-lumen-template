<?php

/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Base\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();

        if (!$token) {
            // Unauthorized response if token not there
            return response()->json(['error' => 'Token not provided.'], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Provided token is expired.'], 400);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error while decoding token.'], 400);
        }

        $sub = $credentials->sub;
        if (isset($sub->id) && isset($sub->email) && isset($sub->password)) {
            /** @var User $user */
            $user = User::find($sub->id);
            if ($user) {
                if (($user->password === $sub->password)
                    && ($user->email === $sub->email)
                ) {

                    $request->auth = $user;
                    return $next($request);
                }
            }
        }

        return response()->json(['error' => 'An error while decoding token.'], 400);
    }
}

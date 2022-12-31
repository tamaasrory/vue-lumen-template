<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param $permission
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        /** @var \App\User $auth */
        $auth = $request->auth;

        if (!$auth) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if ($auth->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}

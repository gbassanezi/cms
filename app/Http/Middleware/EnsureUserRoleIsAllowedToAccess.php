<?php

namespace App\Http\Middleware;

use App\Models\UserPermissions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $userRole = auth()->user()->role;
            $route = Route::currentRouteName();

            if(UserPermissions::isRoleHasRightToAccess($userRole, $route) || in_array($route, $this->defaultUserAccessRole()[$userRole])){
                return $next($request);
            }else{
                abort(403, 'Ur not allowed here o.o');
            }

        } catch (\Throwable $th) {
            abort(403, 'Ur not allowed here o.o');
        }
    }

    private function defaultUserAccessRole()
    {
        return [
            'admin' => [
                'user-permissions'
            ]
        ];
    }
}

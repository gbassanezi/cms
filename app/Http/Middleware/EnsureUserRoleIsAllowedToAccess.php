<?php

namespace App\Http\Middleware;

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

        $userRole = auth()->user()->role;
        $route = Route::currentRouteName();

        // echo 'from the logic, we need harmony of body and mind so we can archive bigger purposes!<br/>';
        // echo 'Olá ' . $userRole . ' vc não tem permissão de acesso a ' . $route . '!';

        if(in_array($route, $this->userAccessRole()[$userRole])){
            return $next($request);
        }else{
            abort(403, 'Ur not allowed here o.o');
        }

    }

    private function userAccessRole()
    {
        return [
            'user' => [
                'dashboard'
            ],
            'admin' => [
                'pages',
                'nav-menus',
            ]
            ];
    }
}

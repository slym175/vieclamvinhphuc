<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class CanAccessAdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole('super-admin') == 'admin' || auth()->user()->hasPermissionTo('access admin')) {
            auth()->user()->createToken('Access Admin Feature Token', ['can-access-admin']);
            return $next($request);
        }
        return redirect(RouteServiceProvider::HOME);
    }
}

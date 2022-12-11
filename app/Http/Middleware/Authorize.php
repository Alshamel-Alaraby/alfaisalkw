<?php

namespace App\Http\Middleware;

use App\Common\Support\PermissionsTrait;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authorize
{

    use PermissionsTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $guard = $guard ?: config('auth.defaults.guard');
        $permission = $this->getPermissionFromRequest($request,$guard);
        if(! Auth::guard($guard)->user()->can($permission['permission']) ) {
            return back()->with('alert-danger','Unauthorized action');
        }
        return $next($request);
    }
}

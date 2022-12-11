<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->is(['backend2', 'backend2/*'])) {
            return route('backend.show.login.form');
        }else {
            return route('frontend.showLoginForm');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateWeb extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        \Log::info(\Auth::guard('web')->user()->firstName);
        if (! $request->expectsJson()) {
            \Log::info('Suka!!!!!');
            return route('login');
        }
    }
}

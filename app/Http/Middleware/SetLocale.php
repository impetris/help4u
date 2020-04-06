<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() instanceof \App\User) {
            app()->setLocale($request->user()->locale);
        } else {
            app()->setLocale(session('locale', 'de-CH'));
        }

        return $next($request);
    }
}

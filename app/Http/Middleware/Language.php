<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = config('app.locale');
        if ($request->session()->has('user.language')) {
            $locale = $request->session()->get('user.language');
        }
        App::setLocale($locale);

        return $next($request);
    }
}

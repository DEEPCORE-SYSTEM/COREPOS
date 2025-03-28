<?php

namespace Modules\Connector\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDemo
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.env') == 'demo') {
            abort(403, 'This feature is disabled in demo');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Modules\Ecommerce\Entities\EcomApiSetting; // Ensure this class exists in the specified namespace

class EcomApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('API-TOKEN');
        $is_api_settings_exists = EcomApiSetting::where('api_token', $token)
                                            // ->where('shop_domain', $shop_domain)
            ->exists();

        if (! $is_api_settings_exists) {
            exit('Invalid Request');
        }

        return $next($request);
    }
}

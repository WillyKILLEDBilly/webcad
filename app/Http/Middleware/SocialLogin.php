<?php

namespace App\Http\Middleware;

use Closure;

class SocialLogin
{
    /**
     * Availables providers.
     *
     * @var array
     */
    protected $availableProviders = [
        'google',
        'facebook'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->provider, $this->availableProviders, true))
            return $next($request);
        
        abort(404);  
    }
}
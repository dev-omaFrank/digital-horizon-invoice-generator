<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function handle(Request $request, Closure $next){
        if(!auth()->user() || auth()->user()->isPro()){
            return redirect()->route('')
            ->with('error', 'Upgrade to access this feature.'); //redirect to payment form
        }

        return $next($request);
    }
}

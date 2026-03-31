<?php

namespace App\Http\Middleware;

use App\Models\BusinessModel;
use App\Models\ClientModel;
use App\Models\Invoice;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkFreeLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('billing/upgrade')) {
            return $next($request);
        }

        $userId = auth()->id();

        if (
            Invoice::where('user_id', $userId)->count() >= 3 ||
            BusinessModel::where('user_id', $userId)->count() >= 3
        ) {
            return redirect('billing/upgrade');
        }

        return $next($request);
    }
}

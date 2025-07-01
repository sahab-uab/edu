<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SiteMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $siteSetting = SiteSetting::first();
        if ($siteSetting && $siteSetting->maintenance_mode) {
            if (Auth::check() && Auth::user()->role == 'admin') {
                return $next($request);
            }
            return to_route('ui.maintenance');
        }
        return $next($request);
    }
}

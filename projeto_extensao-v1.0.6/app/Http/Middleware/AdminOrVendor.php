<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrVendor
{
    public function handle($request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && ($user->access_level === 'admin' || $user->access_level === 'vendor')) {
            return $next($request);
        }

        return redirect()->route('site.index');
    }
}
<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (auth()->check()) {
            switch (auth()->user()->keterangan) {
                case 'Admin':
                    return redirect()->route('dashboard_admin');
                case 'Guru':
                    return redirect()->route('dashboard_guru');
                case 'Wali Murid':
                    return redirect()->route('dashboard_wali_murid');
            }
        }

        return $next($request);
    }

}

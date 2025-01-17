<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek jika pengguna sudah login

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')
                ->with([
                    'message' => 'Anda sudah login sebagai admin',
                    'alert-type' => 'error'
                ]);
        } elseif (Auth::guard('dokter')->check()) {
            return redirect()->route('dokter.dashboard')
                ->with([
                    'message' => 'Anda sudah login sebagai dokter',
                    'alert-type' => 'error'
                ]);
        } elseif (Auth::guard('pasien')->check()) {
            return redirect()->route('homepage')
                ->with([
                    'message' => 'Anda sudah login sebagai pasien',
                    'alert-type' => 'error'
                ]);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PasienMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('pasien')->check()) {
            return $next($request); // Jika pengguna adalah pasien, lanjutkan request
        }

        return redirect()->route('login')
            ->with([
                'message' => 'Anda harus login sebagai pasien untuk mengakses halaman ini',
                'alert-type' => 'error'
            ]);
    }
}

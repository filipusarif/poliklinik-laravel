<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('getAuthenticatedUser')) {
    /**
     * Dapatkan pengguna yang sedang login dari guard apa pun.
     */
    function getAuthenticatedUser()
    {
        $guards = ['admin', 'dokter', 'pasien']; // Daftar guard yang digunakan
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->user();
            }
        }
        return null; // Jika tidak ada pengguna yang login
    }
}

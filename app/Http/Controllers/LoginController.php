<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Pasien;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login'); // Tampilkan form login
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|numeric|digits_between:10,15',
            'password' => 'required|string|min:8',
        ]);

        $no_hp = $request->no_hp;
        $password = $request->password;

        // 1. Cek di tabel Admin
        $admin = Admin::where('no_hp', $no_hp)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin); // Gunakan guard admin
            return redirect()->route('admin.dashboard')
                ->with([
                    'message' => 'Selamat datang di halaman admin!',
                    'alert-type' => 'success'
                ]);
        }

        // 2. Cek di tabel Dokter
        $dokter = Dokter::where('no_hp', $no_hp)->first();
        if ($dokter && Hash::check($password, $dokter->password)) {
            Auth::guard('dokter')->login($dokter); // Gunakan guard dokter
            return redirect()->route('dokter.dashboard')
                ->with([
                    'message' => 'Selamat datang di halaman dokter!',
                    'alert-type' => 'success'
                ]);
        }

        // 3. Cek di tabel Pasien
        $pasien = Pasien::where('no_hp', $no_hp)->first();
        if ($pasien && Hash::check($password, $pasien->password)) {
            Auth::guard('pasien')->login($pasien); // Gunakan guard pasien
            return redirect()->route('pasien.riwayat.index')
                ->with([
                    'message' => 'Selamat datang di halaman pasien!',
                    'alert-type' => 'success'
                ]);
        }

        // Jika tidak ditemukan, kembalikan dengan error
        return back()->withErrors([
            'no_hp' => 'Nomor HP atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        $guards = ['admin', 'dokter', 'pasien']; // Daftar guard yang digunakan
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homepage')
            ->with([
                'message' => 'Anda telah logout.',
                'alert-type' => 'success'
            ]);
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegistrasiController extends Controller
{
    //
    public function index()
    {
        return view('auth.registrasi');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:pasien',
            'no_ktp' => 'required|numeric|digits:16|unique:pasien',
            'password' => 'required|string|min:8',
        ]);

        // Generate No RM
        $no_rm = $this->generateNoRM();

        // Data yang akan disimpan
        $createData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $no_rm,
        ];

        // Jika password diisi, hash password dan tambahkan ke data
        if ($request->filled('password')) {
            $createData['password'] = Hash::make($request->password); // Hash password
        }

        // Menyimpan data pasien baru
        $pasien = Pasien::create($createData);

        // Autentikasi langsung setelah registrasi
        Auth::guard('pasien')->login($pasien); // Gunakan guard pasien

        // Redirect ke homepage setelah berhasil login
        return redirect()->route('homepage')
            ->with([
                'message' => 'Pasien berhasil ditambahkan dan berhasil login!',
                'alert-type' => 'success'
            ]);
    }

    public function generateNoRM()
    {
        // Ambil tahun dan bulan sekarang
        $tahun = Carbon::now()->year; // Tahun saat ini (misalnya 2024)
        $bulan = Carbon::now()->month; // Bulan saat ini (misalnya 11 untuk November)

        // Ambil jumlah pasien yang terdaftar pada bulan dan tahun ini
        $jumlah_pasien = Pasien::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->count();

        // Urutan pasien berikutnya
        $urutan = $jumlah_pasien + 1;

        // Format No RM
        $no_rm = $tahun . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-' . $urutan;

        return $no_rm;
    }
}

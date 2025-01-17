<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    //
    public function index()
    {
        $pasien = auth()->guard('pasien')->user();
        return view('pasien.profil.index', compact('pasien'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:pasien,no_hp,' . auth()->guard('pasien')->user()->id,
            'no_ktp' => 'required|numeric|digits:16|unique:pasien,no_ktp,' . auth()->guard('pasien')->user()->id,
            'no_rm' => 'required|string|max:25',
        ]);

        $pasien = Pasien::find(auth()->guard('pasien')->user()->id);

        $pasien->update([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'no_ktp' => $request->input('no_ktp'),
            'no_rm' => $request->input('no_rm'),
        ]);

        return redirect()->route('pasien.profil.index')->with([
            'message' => 'Profil berhasil diubah!',
            'alert-type' => 'success'
        ]);
    }

    // Mengupdate password pasien
    public function updatePassword(Request $request)
    {
        $pasien = Pasien::find(auth()->guard('pasien')->user()->id);

        // Validasi input password
        $request->validate([
            'password_sekarang' => 'required|string|min:8',
            'password_baru' => 'required|string|min:8', // Password baru harus sesuai dengan konfirmasi
            'konfirmasi_password' => 'required|string|min:8|same:password_baru', // Konfirmasi password harus sama dengan password baru
        ]);

        // Memastikan password lama benar
        if (!Hash::check($request->password_sekarang, $pasien->password)) {
            return redirect()->back()->withErrors(['password_sekarang' => 'Password lama salah'])->withInput();
        }

        // Mengupdate password pasien
        $pasien->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return redirect()->back()->with([
            'message' => 'Password berhasil diubah!',
            'alert-type' => 'success'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Poli;

class ProfilController extends Controller
{
    //
    public function index()
    {
        $dokter = Auth::user();
        $polis = Poli::all();
        return view('dokter.profil.index', compact('dokter', 'polis'));
    }

    public function editProfil(Request $request)
    {
        // Get the currently authenticated user
        $dokter = Auth::user();

        // Validate the request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:admin,no_hp,' . $dokter->id, // Exclude the current record
            'alamat' => 'required|string',
            'id_poli' => 'required|exists:poli,id',
        ]);


         // Update data admin
        $dokter->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'id_poli' => $request->id_poli
        ]);

        // Redirect back with success message
        return redirect()->route('dokter.profil.index')
            ->with([
                'message' => 'Profil berhasil diubah!',
                'alert-type' => 'success',
            ]);

    }

    public function editPassword(Request $request)
    {
        // Get the currently authenticated user
        $dokter = Auth::user();

        // Periksa apakah password saat ini cocok
        if (!Hash::check($request->current_password, $dokter->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }
        
        // Validate the request data
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        // Update data admin
        $dokter->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Redirect back with success message
        return redirect()->route('dokter.profil.index')
            ->with([
                'message' => 'Password berhasil diubah!',
                'alert-type' => 'success',
            ]);
    }
}

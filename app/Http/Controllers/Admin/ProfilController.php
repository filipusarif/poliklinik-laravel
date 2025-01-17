<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    //
    public function index()
    {
        $admin = Auth::user();

        return view('admin.profil.index', compact('admin'));
    }

    public function editProfil(Request $request)
    {
        // Get the currently authenticated user
        $admin = Auth::user();

        // Validate the request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:admin,no_hp,' . $admin->id, // Exclude the current record
            'alamat' => 'required|string',
        ]);


         // Update data admin
        $admin->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.profil.index')
            ->with([
                'message' => 'Profil berhasil diubah!',
                'alert-type' => 'success',
            ]);

    }

    public function editPassword(Request $request)
    {
        // Get the currently authenticated user
        $admin = Auth::user();

        // Periksa apakah password saat ini cocok
        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }
        
        // Validate the request data
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        // Update data admin
        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Redirect back with success message
        return redirect()->route('admin.profil.index')
            ->with([
                'message' => 'Password berhasil diubah!',
                'alert-type' => 'success',
            ]);
    }
}

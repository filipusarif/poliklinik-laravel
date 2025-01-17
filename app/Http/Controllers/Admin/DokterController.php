<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    //
    public function index()
    {
        $dokters = Dokter::all();

        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);

        $polis = Poli::all();

        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }
    
    public function store(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:dokter',
            'password' => 'required|string|min:8',
            'id_poli' => 'required|exists:poli,id',
        ]);

        // Persiapkan data untuk disimpan
        $createData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
        ];

        // Jika password diisi, hash password dan tambahkan ke data yang akan disimpan
        if ($request->filled('password')) {
            $createData['password'] = Hash::make($request->password); // Hash password
        }

        // Simpan data dokter baru ke database
        Dokter::create($createData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.dokter.index')
            ->with([
                'message' => 'Dokter berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:dokter,no_hp,' . $dokter->id,
            'password' => 'nullable|string|min:8',
            'id_poli' => 'required|exists:poli,id',
        ]);

        // Menyiapkan data untuk diupdate
        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
        ];

        if ($request->filled('password')) {
            // Gunakan Hash::make untuk meng-hash password
            $updateData['password'] = Hash::make($request->password);
        }

        // Memperbarui dokter
        $dokter->update($updateData);

        return redirect()->route('admin.dokter.index')
            ->with([
                'message' => 'Dokter berhasil diperbarui!',
                'alert-type' => 'success'
            ]);
    }

    public function destroy(Dokter $dokter)
    {
        // Menghapus dokter menggunakan soft delete
        $dokter->delete();

        return redirect()->route('admin.dokter.index')
            ->with([
                'message' => 'Dokter berhasil dihapus!',
                'alert-type' => 'success'
            ]);
    }
}

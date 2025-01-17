<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    //
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function edit($id)
    {
        $obat = Obat::find($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|numeric|regex:/^\d{1,10}$/',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')
            ->with([
                'message' => 'Obat berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama_obat' => 'required|string|max:50',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|numeric|regex:/^\d{1,10}$/',
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')
            ->with([
                'message' => 'Obat berhasil diperbarui!',
                'alert-type' => 'success'
            ]);
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('admin.obat.index')
            ->with([
                'message' => 'Obat berhasil dihapus!',
                'alert-type' => 'success'
            ]);
    }
}

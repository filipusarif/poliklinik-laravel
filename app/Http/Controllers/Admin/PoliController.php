<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    //
    public function index(){
        $polis = Poli::all();

        return view('admin.poli.index', compact('polis'));
    }

    public function create(){
        return view('admin.poli.create');
    }

    public function edit($id){
        $poli = Poli::findOrFail($id);

        return view('admin.poli.edit', compact('poli'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.poli.index')
            ->with([
                'message' => 'Poli berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $poli = Poli::findOrFail($id);

        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.poli.index')
            ->with([
                'message' => 'Poli berhasil diubah!',
                'alert-type' => 'success'
            ]);
    }

    public function destroy($id){
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('admin.poli.index')
            ->with([
                'message' => 'Poli berhasil dihapus!',
                'alert-type' => 'success'
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\Dokter;

class DokterKonsultasiController extends Controller
{
    //
    public function index()
    {
        $dokter = auth()->guard('dokter')->user();

        // $konsultasis = Konsultasi::where('id_pasien', $pasien->id)->get();
        $konsultasis = Konsultasi::with('dokter')
        ->where('id_dokter', $dokter->id)
        ->get();

        return view('dokter.konsultasi.index', compact('dokter', 'konsultasis'));
    }


    public function edit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        $dokters = Dokter::all();
        

        return view('dokter.konsultasi.edit', compact('konsultasi', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required|string|max:500',
        ]);
        
        Konsultasi::updateOrCreate(
            ['id' => $id], 
            [ 
                'id' => $id,
                'jawaban' => $request->jawaban,
            ]
        );

        return redirect()->route('dokter.konsultasi.index')
            ->with([
                'message' => 'Dokter berhasil diperbarui!',
                'alert-type' => 'success'
            ]);
    }
}

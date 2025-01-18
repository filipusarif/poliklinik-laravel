<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\JadwalPraktik;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Konsultasi;
use App\Models\Dokter;


class PasienKonsultasiController extends Controller
{
    //
    public function index()
    {
        $pasien = auth()->guard('pasien')->user();

        // $konsultasis = Konsultasi::where('id_pasien', $pasien->id)->get();
        $konsultasis = Konsultasi::with('dokter')
        ->where('id_pasien', $pasien->id)
        ->get();

        return view('pasien.riwayat.konsultasi', compact('pasien', 'konsultasis'));
    }

    public function create()
    {
        $konsultasi = Konsultasi::all();
        $dokters = Dokter::all();
        return view('pasien.riwayat.create', compact('konsultasi','dokters'));
    }

    public function store(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'id' =>  'required|exists:dokter,id',
            'subject' => 'required|string|max:500',
            'pertanyaan' => 'required|string|max:500',
        ]);


        $pasien = auth()->guard('pasien')->user();

        // Persiapkan data untuk disimpan
        $createData = [
            'id_dokter' => $request->id,
            'id_pasien' => $pasien->id,
            'subject' => $request->subject,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => " ",
            'tgl_konsultasi' => now()
        ];

        // Simpan data dokter baru ke database
        Konsultasi::create($createData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pasien.konsultasi.index')
            ->with([
                'message' => 'Dokter berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
    }

    public function edit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        $dokters = Dokter::all();
        

        return view('pasien.riwayat.edit', compact('konsultasi', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' =>  'required|exists:dokter,id',
            'subject' => 'required|string|max:500',
            'pertanyaan' => 'required|string|max:500',
        ]);

        $pasien = auth()->guard('pasien')->user();
        
        
        Konsultasi::updateOrCreate(
            ['id' => $id], 
            [ 
                'id' => $id,
                'id_dokter' => $request->id,
                'id_pasien' => $pasien->id,
                'subject' => $request->subject,
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => " ",
                'tgl_konsultasi' => now()
            ]
        );

        return redirect()->route('pasien.konsultasi.index')
            ->with([
                'message' => 'Dokter berhasil diperbarui!',
                'alert-type' => 'success'
            ]);
    }

    public function destroy($id)
    {
        $user = Konsultasi::findOrFail($id);
        $user->delete();

        return redirect()->route('pasien.konsultasi.index')
            ->with([
                'message' => 'Dokter berhasil dihapus!',
                'alert-type' => 'success'
            ]);
    }
}

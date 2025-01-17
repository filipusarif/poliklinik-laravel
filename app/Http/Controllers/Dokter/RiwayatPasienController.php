<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Pasien;
use Illuminate\Http\Request;

class RiwayatPasienController extends Controller
{
    //
    public function index()
    {
        $idDokter = auth()->guard('dokter')->user()->id;

        $pasiens = DaftarPoli::with(['pasien', 'jadwalPraktik.dokter'])
            ->whereHas('jadwalPraktik', function ($query) use ($idDokter) {
                $query->where('id_dokter', $idDokter);
            })
            ->selectRaw('*, COUNT(*) OVER (PARTITION BY id_pasien) as total_periksa')
            ->orderBy('tgl_periksa', 'desc')
            ->get()
            ->unique('id_pasien');

        return view('dokter.riwayat_pasien.index', compact('pasiens'));
    }

    public function pasien($id)
    {
        $idDokter = auth()->guard('dokter')->user()->id;

        $riwayatPasien = DaftarPoli::with(['pasien', 'jadwalPraktik.dokter', 'periksa', 'periksa.detailPeriksa', 'periksa.detailPeriksa.obat'])
            ->whereHas('jadwalPraktik', function ($query) use ($idDokter) {
                $query->where('id_dokter', $idDokter);
            })
            ->where('id_pasien', $id)
            ->get();

        if ($riwayatPasien->isEmpty()) {
            return redirect()->route('dokter.riwayat_pasien.index')->with([
                'message' => 'Pasien tidak ditemukan',
                'alert-type' => 'error'
            ]);
        }

        $pasien = $riwayatPasien->first()->pasien;

        return view('dokter.riwayat_pasien.pasien', compact('riwayatPasien', 'pasien'));
    }
}

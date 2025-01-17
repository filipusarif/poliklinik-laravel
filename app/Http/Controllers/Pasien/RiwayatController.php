<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\JadwalPraktik;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;


class RiwayatController extends Controller
{
    //
    public function index()
    {
        $pasien = auth()->guard('pasien')->user();

        $polis = Poli::all();

        $riwayats = DaftarPoli::where('id_pasien', $pasien->id)->get();

        return view('pasien.riwayat.index', compact('pasien', 'polis', 'riwayats'));
    }

    public function getJadwal($id_poli)
    {
        $jadwals = JadwalPraktik::whereHas('dokter', function ($query) use ($id_poli) {
            $query->where('id_poli', $id_poli);
        })
            ->where('is_active', 1)
            ->with('dokter:id,nama')
            ->get(['id', 'hari', 'jam_mulai', 'jam_selesai', 'id_dokter']);

        return response()->json($jadwals);
    }

    public function daftarPoli(Request $request)
    {
        $request->validate([
            'poli' => 'required|exists:poli,id',
            'tgl_periksa' => 'required|date|after:today|before_or_equal:' . now()->addDays(30)->toDateString(),
            'jadwal' => 'required|exists:jadwal_praktik,id',
            'keluhan' => 'required|string|max:255',
        ]);

        $pasien = auth()->guard('pasien')->user();
        $jadwal = JadwalPraktik::findOrFail($request->jadwal);

        // Cek apakah pasien sudah mendaftar pada jadwal dan tanggal yang sama
        $existingEntry = DaftarPoli::where('id_pasien', $pasien->id)
            ->where('id_jadwal', $request->jadwal)
            ->where('tgl_periksa', $request->tgl_periksa)
            ->exists();

        if ($existingEntry) {
            return redirect()->back()->with([
                'message' => 'Anda sudah terdaftar untuk jadwal ini pada tanggal tersebut.',
                'alert-type' => 'error'
            ]);
        }

        // Hitung antrian saat ini
        $noAntrian = DaftarPoli::where('id_jadwal', $request->jadwal)
            ->where('tgl_periksa', $request->tgl_periksa)
            ->max('no_antrian') + 1;

        // Cek apakah melebihi batas maksimal
        if ($noAntrian > $jadwal->max_antrian) {
            return redirect()->back()->with([
                'message' => 'Maaf, kuota antrian sudah penuh untuk jadwal ini.',
                'alert-type' => 'error'
            ]);
        }

        // Buat pendaftaran baru
        DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $request->jadwal,
            'tgl_periksa' => $request->tgl_periksa,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->route('pasien.riwayat.index')->with([
            'message' => 'Pendaftaran berhasil!',
            'alert-type' => 'success'
        ]);
    }

    public function detail($id)
    {
        $pasien = auth()->guard('pasien')->user();

        $daftarpoli = DaftarPoli::find($id);
        $periksa = Periksa::where('id_daftar_poli', $id)->first();

        $obats = Obat::all();

        // Ambil daftar obat jika ada data periksa, jika tidak kosongkan array
        $daftarObat = $periksa
            ? DetailPeriksa::where('id_periksa', $periksa->id)->pluck('id_obat')->toArray()
            : [];

        if (is_null($daftarpoli) || $daftarpoli->id_pasien != $pasien->id) {
            return redirect()->back()->with([
                'message' => 'Data tidak ditemukan',
                'alert-type' => 'error',
            ]);
        }

        return view('pasien.riwayat.detail', compact('daftarpoli', 'periksa', 'obats', 'daftarObat'));
    }
}

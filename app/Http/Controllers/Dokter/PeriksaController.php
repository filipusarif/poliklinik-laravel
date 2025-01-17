<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    //
    public function index(Request $request)
    {
        $dokter = auth()->guard('dokter')->user();
        $jadwalId = $dokter->jadwalPraktik->pluck('id');

        $query = DaftarPoli::whereIn('id_jadwal', $jadwalId)
            ->with('periksa'); // Load relasi periksa

        // Filter berdasarkan tanggal hari ini
        if ($request->has('today')) {
            $query->whereDate('tgl_periksa', \Carbon\Carbon::today());
        }

        $daftarPolis = $query->get();

        return view('dokter.periksa.index', compact('daftarPolis'));
    }


    public function detail($id)
    {
        $dokter = auth()->guard('dokter')->user();
        $daftarpoli = DaftarPoli::with('jadwalPraktik')->findOrFail($id);

        if ($daftarpoli->jadwalPraktik->dokter->id != $dokter->id) {
            return redirect()->back()->with([
                'message' => 'Data tidak ditemukan',
                'alert-type' => 'error',
            ]);
        }

        $obats = Obat::all();
        $periksa = Periksa::where('id_daftar_poli', $id)->first();

        // Ambil daftar obat jika ada data periksa, jika tidak kosongkan array
        $daftarObat = $periksa
            ? DetailPeriksa::where('id_periksa', $periksa->id)->pluck('id_obat')->toArray()
            : [];

        return view('dokter.periksa.detail', compact('daftarpoli', 'obats', 'periksa', 'daftarObat'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required',
            'obat' => 'required|array|min:1',
        ]);

        // Cari data DaftarPoli
        $daftarpoli = DaftarPoli::findOrFail($id);

        // Ambil semua obat berdasarkan ID yang dipilih
        $obats = Obat::whereNull('deleted_at')->whereIn('id', $request->obat)->get();

        // Hitung total biaya
        $biaya = 150000;
        foreach ($obats as $obat) {
            $biaya += $obat->harga;
        }

        // Cari data periksa yang sudah ada atau buat data baru
        $periksa = Periksa::updateOrCreate(
            ['id_daftar_poli' => $daftarpoli->id],
            [
                'tgl_periksa' => $daftarpoli->tgl_periksa,
                'catatan' => $request->catatan,
                'biaya_periksa' => $biaya
            ]
        );

        // Hapus semua detail periksa sebelumnya untuk data periksa ini
        $periksa->detailPeriksa()->delete();

        // Tambahkan data detail periksa baru
        foreach ($obats as $obat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obat->id,
            ]);
        }

        return redirect()->route('dokter.periksa.index')->with([
            'message' => 'Berhasil memeriksa pasien!',
            'alert-type' => 'success',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Obat;
use App\Models\Periksa;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $dokter = auth()->guard('dokter')->user();
        $jumlah_dokter = Dokter::all()->count();
        $jumlah_poli = Poli::all()->count();
        $jumlah_obat = Obat::all()->count();

        $jadwalId = $dokter->jadwalPraktik->pluck('id');

        // Menghitung jumlah pasien
        $jumlah_pasien = DaftarPoli::whereIn('id_jadwal', $jadwalId)
            ->with('periksa') // Load relasi periksa
            ->count();

        // Menghitung jumlah pasien per bulan
        $jumlah_pasien_per_bulan = DaftarPoli::whereIn('id_jadwal', $jadwalId)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan') // Hasilnya berupa [bulan => jumlah]
            ->toArray();

        // Format data pasien agar sesuai untuk grafik (Jan - Dec)
        $data_pasien = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_pasien[] = $jumlah_pasien_per_bulan[$i] ?? 0; // Isi dengan 0 jika tidak ada data
        }

        // Ambil 4 daftar poli terbaru
        $jadwalId = $dokter->jadwalPraktik->pluck('id');
        $daftarPolisTerbaru = DaftarPoli::whereIn('id_jadwal', $jadwalId)
            ->with('pasien')
            ->limit(4)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil 4 pasien terbaru
        $pasienId = $daftarPolisTerbaru->pluck('id_pasien')->toArray();
        $daftarPasienTerbaru = Pasien::whereIn('id', $pasienId)->limit(4)->get();

        return view('dokter.dashboard.index', compact(
            'jumlah_dokter',
            'jumlah_pasien',
            'jumlah_poli',
            'jumlah_obat',
            'data_pasien',
            'daftarPolisTerbaru',
            'daftarPasienTerbaru'
        ));
    }
}

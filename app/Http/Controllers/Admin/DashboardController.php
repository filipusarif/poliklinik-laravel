<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Obat;

class DashboardController extends Controller
{
    //
    public function index(){
        $jumlah_dokter = Dokter::all()->count();
        $jumlah_pasien = Pasien::all()->count();
        $jumlah_poli = Poli::all()->count();
        $jumlah_obat = Obat::all()->count();

        // Menghitung jumlah pasien per bulan
        $jumlah_pasien_per_bulan = DaftarPoli::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan') // Hasilnya berupa [bulan => jumlah]
            ->toArray();

        // Format data pasien agar sesuai untuk grafik (Jan - Dec)
        $data_pasien = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_pasien[] = $jumlah_pasien_per_bulan[$i] ?? 0; // Isi dengan 0 jika tidak ada data
        }

        // Ambil 5 obat terbaru
        $daftarObatTerbaru = Obat::orderBy('created_at', 'desc')->limit(5)->get();
        
        // Ambil 5 Pasien terbaru
        $daftarPasienTerbaru = Pasien::orderBy('created_at', 'desc')->limit(5)->get();


        return view('admin.dashboard.index', compact(
            'jumlah_dokter',
            'jumlah_pasien',
            'jumlah_poli',
            'jumlah_obat',
            'data_pasien',
            'daftarObatTerbaru',
            'daftarPasienTerbaru'
        ));
    }
}

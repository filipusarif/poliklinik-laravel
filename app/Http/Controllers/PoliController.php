<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;

class PoliController extends Controller
{
    //
    public function index()
    {
        $dokters = Dokter::with(['poli', 'jadwalPraktik' => function($query) {
            $query->where('is_active', 1);
        }])->get();

        // Mengelompokkan jadwal berdasarkan hari
        foreach ($dokters as $dokter) {
            $jadwalGrouped = $dokter->jadwalPraktik->groupBy('hari');
            $dokter->groupedJadwal = $jadwalGrouped;
        }

        $polis = Poli::all();

        return view('frontend.poli.index', compact('dokters', 'polis'));
    }
}

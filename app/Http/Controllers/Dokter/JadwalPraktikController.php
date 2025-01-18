<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktik;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalPraktikController extends Controller
{
    //
    public function index()
    {
        $dokter = Auth::guard('dokter')->user();

        // Ambil semua jadwal praktik berdasarkan dokter
        $jadwal_praktik = JadwalPraktik::where('id_dokter', $dokter->id)->get();

        // Kelompokkan jadwal berdasarkan hari
        $jadwal_by_day = $jadwal_praktik->groupBy('hari');

        // Daftar hari untuk looping (sesuaikan dengan bahasa yang digunakan)
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Format data jadwal menjadi format yang diterima FullCalendar
        $events = [];
        foreach ($jadwal_by_day as $day => $jadwals) {
            foreach ($jadwals as $jadwal) {
                $dayIndex = array_search($day, $days); // Mendapatkan indeks hari

                // Tentukan class berdasarkan status aktif atau tidak
                $className = $jadwal->is_active ? 'bg-success' : 'bg-danger';

                $events[] = [
                    'title' => 'Praktik Dokter', // Bisa disesuaikan sesuai kebutuhan
                    'daysOfWeek' => [$dayIndex], // Indeks hari (0 = Minggu, 1 = Senin, dst.)
                    'startTime' => \Carbon\Carbon::parse($jadwal->jam_mulai)->format('Y-m-d H:i:s'), // Format dengan jam
                    'endTime' => \Carbon\Carbon::parse($jadwal->jam_selesai)->format('Y-m-d H:i:s'), // Format dengan jam
                    'className' => $className, // Menambahkan class berdasarkan status aktif
                ];
            }
        }

        return view('dokter.jadwal_praktik.index', compact('jadwal_by_day', 'days', 'events'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $dokter = Auth::guard('dokter')->user();

        // Cek apakah waktu bertabrakan
        $existingSchedule = JadwalPraktik::where('id_dokter', $dokter->id)
            ->where('is_active',1)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })->exists();
        // $existingSchedule = JadwalPraktik::where('id_dokter', $dokter->id)
        //     ->where('hari', $request->hari)
        //     ->where(function ($query) use ($request) {
        //         $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
        //             ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
        //             ->orWhere(function ($query) use ($request) {
        //                 $query->where('jam_mulai', '<=', $request->jam_mulai)
        //                     ->where('jam_selesai', '>=', $request->jam_selesai);
        //             });
        //     })->exists();

        if ($existingSchedule) {
            return redirect()->back()->with([
                'message' => 'Jadwal praktik bertabrakan dengan jadwal yang sudah ada!',
                'alert-type' => 'error'
            ]);
        }

        // Cek apakah waktu bertabrakan
        $existingDay = JadwalPraktik::where('id_dokter', $dokter->id)
            ->where('hari', $request->hari)
            ->where('is_active',1)
            ->exists();

        if ($existingDay) {
            return redirect()->back()->with([
                'message' => 'Jadwal praktik pada hari '. $request->hari.' sudah ada!',
                'alert-type' => 'error'
            ]);
        }

        // Nonaktifkan jadwal lain
        JadwalPraktik::where('id_dokter', $dokter->id)->update(['is_active' => false]);

        // Simpan jadwal baru
        JadwalPraktik::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'is_active' => true,
        ]);

        return redirect()->route('dokter.jadwal_praktik.index')
            ->with([
                'message' => 'Jadwal praktik berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
    }

    public function deactivate($id)
    {
        $jadwal = JadwalPraktik::findOrFail($id);

        $currentDay = Carbon::now()->translatedFormat('l');
        if ($jadwal->hari === $currentDay) {
            return redirect()->route('dokter.jadwal_praktik.index')
                ->with([
                    'message' => 'Anda tidak dapat menonaktifkan jadwal praktik hari ini.',
                    'alert-type' => 'error'
                ]);
        }

        if (!$jadwal->is_active) {
            return redirect()->route('dokter.jadwal_praktik.index')
                ->with([
                    'message' => 'Jadwal praktik sudah dinonaktifkan sebelumnya.',
                    'alert-type' => 'warning'
                ]);
        }

        // Nonaktifkan jadwal
        $jadwal->update(['is_active' => false]);

        return redirect()->route('dokter.jadwal_praktik.index')
            ->with([
                'message' => 'Jadwal praktik berhasil dinonaktifkan!',
                'alert-type' => 'success'
            ]);
    }

    public function activate($id)
    {
        $jadwal = JadwalPraktik::findOrFail($id);

        if ($jadwal->is_active) {
            return redirect()->route('dokter.jadwal_praktik.index')
                ->with([
                    'message' => 'Jadwal praktik sudah diaktifkan sebelumnya.',
                    'alert-type' => 'warning'
                ]);
        }

        // Nonaktifkan jadwal lain
        JadwalPraktik::where('id_dokter', $jadwal->id_dokter)->update(['is_active' => false]);

        // Aktifkan jadwal
        $jadwal->update(['is_active' => true]);

        return redirect()->route('dokter.jadwal_praktik.index')
            ->with([
                'message' => 'Jadwal praktik berhasil diaktifkan!',
                'alert-type' => 'success'
            ]);
    }
}

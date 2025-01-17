<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PasienController extends Controller
{
    //
    public function index()
    {
        $pasiens = Pasien::all();

        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        $no_rm = $this->generateNoRM(); // Generate No RM
        return view('admin.pasien.create', compact('no_rm'));
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('admin.pasien.edit', compact('pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:pasien',
            'no_ktp' => 'required|numeric|digits:16|unique:pasien',
            'no_rm' => 'required|string|max:25|unique:pasien',
            'password' => 'required|string|min:8',
        ]);

        $createData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $request->no_rm,
        ];

        // Jika password diisi, hash password dan tambahkan ke data yang akan disimpan
        if ($request->filled('password')) {
            $createData['password'] = Hash::make($request->password); // Hash password
        }

        Pasien::create($createData);

        return redirect()->route('admin.pasien.index')
            ->with([
                'message' => 'Pasien berhasil ditambahkan!',
                'alert-type' => 'success'
            ]);
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:pasien,no_hp,' . $pasien->id,
            'no_ktp' => 'required|numeric|digits:16|unique:pasien,no_ktp,' . $pasien->id,
            'no_rm' => 'required|string|max:25',
            'password' => 'nullable|string|min:8',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $request->no_rm,
        ];

        // Jika password diisi, hash password dan tambahkan ke data yang akan disimpan
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password); // Hash password
        }

        $pasien->update($updateData);

        return redirect()->route('admin.pasien.index')
            ->with([
                'message' => 'Pasien berhasil diperbarui!',
                'alert-type' => 'success'
            ]);
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('admin.pasien.index')
            ->with([
                'message' => 'Pasien berhasil dihapus!',
                'alert-type' => 'success'
            ]);
    }
    
    public function generateNoRM()
    {
        // Ambil tahun dan bulan sekarang
        $tahun = Carbon::now()->year; // Tahun saat ini (misalnya 2024)
        $bulan = Carbon::now()->month; // Bulan saat ini (misalnya 11 untuk November)

        // Ambil jumlah pasien yang terdaftar pada bulan dan tahun ini
        $jumlah_pasien = Pasien::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->count();

        // Urutan pasien berikutnya
        $urutan = $jumlah_pasien + 1;

        // Format No RM
        $no_rm = $tahun . str_pad($bulan, 2, '0', STR_PAD_LEFT) . '-' . $urutan;

        return $no_rm;
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PoliController;
// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DokterController as AdminDokterController;
use App\Http\Controllers\Admin\PasienController as AdminPasienController;
use App\Http\Controllers\Admin\PoliController as AdminPoliController;
use App\Http\Controllers\Admin\ObatController as AdminObatController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;

// Dokter
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\PeriksaController as DokterPeriksaController;
use App\Http\Controllers\Dokter\RiwayatPasienController as DokterRiwayatPasienController;
use App\Http\Controllers\Dokter\JadwalPraktikController as DokterJadwalPraktikController;
use App\Http\Controllers\Dokter\ProfilController as DokterProfilController;

// Pasien
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\ProfilController as PasienProfilController;
use App\Http\Controllers\Pasien\RiwayatController as PasienRiwayatController;
use App\Http\Controllers\PasienKonsultasiController;
use App\Http\Controllers\DokterKonsultasiController;
use App\Http\Controllers\RegistrasiController;
use App\Models\Pasien;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/poli', [PoliController::class, 'index'])->name('poli');

Route::middleware(['guest'])->group(function () {
    // Auth
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    // Register
    Route::get('/register', [RegistrasiController::class, 'index'])->name('registrasi');
    Route::post('/register', [RegistrasiController::class, 'store'])->name('registrasi.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grup Middleware untuk Admin
Route::middleware(['auth:admin'])->group(function () {

    // Dashboard
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Dokter
    Route::prefix('/admin/dokter')->group(function () {
        Route::get('/', [AdminDokterController::class, 'index'])->name('admin.dokter.index');
        Route::get('/create', [AdminDokterController::class, 'create'])->name('admin.dokter.create');
        Route::post('/store', [AdminDokterController::class, 'store'])->name('admin.dokter.store');
        Route::get('/edit/{id}', [AdminDokterController::class, 'edit'])->name('admin.dokter.edit');
        Route::put('/{dokter}', [AdminDokterController::class, 'update'])->name('admin.dokter.update');
        Route::delete('/{dokter}', [AdminDokterController::class, 'destroy'])->name('admin.dokter.destroy');
    });

    // CRUD Pasien
    Route::prefix('/admin/pasien')->group(function () {
        Route::get('/', [AdminPasienController::class, 'index'])->name('admin.pasien.index');
        Route::get('/create', [AdminPasienController::class, 'create'])->name('admin.pasien.create');
        Route::post('/store', [AdminPasienController::class, 'store'])->name('admin.pasien.store');
        Route::get('/edit/{id}', [AdminPasienController::class, 'edit'])->name('admin.pasien.edit');
        Route::put('/{pasien}', [AdminPasienController::class, 'update'])->name('admin.pasien.update');
        Route::delete('/{pasien}', [AdminPasienController::class, 'destroy'])->name('admin.pasien.destroy');
    });

    // CRUD Poli
    Route::prefix('/admin/poli')->group(function () {
        Route::get('/', [AdminPoliController::class, 'index'])->name('admin.poli.index');
        Route::get('/create', [AdminPoliController::class, 'create'])->name('admin.poli.create');
        Route::post('/store', [AdminPoliController::class, 'store'])->name('admin.poli.store');
        Route::get('/edit/{id}', [AdminPoliController::class, 'edit'])->name('admin.poli.edit');
        Route::put('/{poli}', [AdminPoliController::class, 'update'])->name('admin.poli.update');
        Route::delete('/{poli}', [AdminPoliController::class, 'destroy'])->name('admin.poli.destroy');
    });

    // CRUD Obat
    Route::prefix('/admin/obat')->group(function () {
        Route::get('/', [AdminObatController::class, 'index'])->name('admin.obat.index');
        Route::get('/create', [AdminObatController::class, 'create'])->name('admin.obat.create');
        Route::post('/store', [AdminObatController::class, 'store'])->name('admin.obat.store');
        Route::get('/edit/{id}', [AdminObatController::class, 'edit'])->name('admin.obat.edit');
        Route::put('/{obat}', [AdminObatController::class, 'update'])->name('admin.obat.update');
        Route::delete('/{obat}', [AdminObatController::class, 'destroy'])->name('admin.obat.destroy');
    });

    // Profil
    Route::get('/admin/profil', [AdminProfilController::class, 'index'])->name('admin.profil.index');
    Route::post('/admin/profil', [AdminProfilController::class, 'editProfil'])->name('admin.profil.update');
    Route::post('/admin/password', [AdminProfilController::class, 'editPassword'])->name('admin.password.update');
});

// Grup Middleware untuk Dokter
Route::middleware(['auth:dokter'])->group(function () {

    // Dashboard
    Route::get('/dokter', function () {
        return redirect()->route('dokter.dashboard');
    });

    // Dashboard
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');

    // Periksa
    Route::get('/dokter/periksa', [DokterPeriksaController::class, 'index'])->name('dokter.periksa.index');
    Route::get('/dokter/periksa/detail/{id}', [DokterPeriksaController::class, 'detail'])->name('dokter.periksa.detail');
    Route::post('/dokter/periksa/store/{id}', [DokterPeriksaController::class, 'store'])->name('dokter.periksa.store');
    Route::put('/dokter/periksa/{id}', [DokterPeriksaController::class, 'update'])->name('dokter.periksa.update');
    Route::delete('/dokter/periksa/{id}', [DokterPeriksaController::class, 'destroy'])->name('dokter.periksa.destroy');

    // Riwayat Pasien
    Route::get('/dokter/riwayat_pasien', [DokterRiwayatPasienController::class, 'index'])->name('dokter.riwayat_pasien.index');
    Route::get('/dokter/riwayat_pasien/detail/{id}', [DokterRiwayatPasienController::class, 'pasien'])->name('dokter.riwayat_pasien.pasien');

    // Jadwal Praktik
    Route::get('/dokter/jadwal', [DokterJadwalPraktikController::class, 'index'])->name('dokter.jadwal_praktik.index');
    Route::post('/dokter/jadwal', [DokterJadwalPraktikController::class, 'store'])->name('dokter.jadwal_praktik.store');
    Route::patch('/jadwal-praktik/{id}/activate', [DokterJadwalPraktikController::class, 'activate'])->name('dokter.jadwal_praktik.activate');
    Route::patch('/jadwal-praktik/{id}/deactivate', [DokterJadwalPraktikController::class, 'deactivate'])->name('dokter.jadwal_praktik.deactivate');

    //Profil
    Route::get('/dokter/profil', [DokterProfilController::class, 'index'])->name('dokter.profil.index');
    Route::post('/dokter/profil', [DokterProfilController::class, 'editProfil'])->name('dokter.profil.update');
    Route::post('/dokter/password', [DokterProfilController::class, 'editPassword'])->name('dokter.password.update');


    // Konsultasi
    Route::get('/dokter/konsultasi', [DokterKonsultasiController::class, 'index'])->name('dokter.konsultasi.index');
    Route::get('/dokter/konslutasi/edit/{id}', [DokterKonsultasiController::class, 'edit'])->name('dokter.konsultasi.edit');
    Route::put('/dokter/konslutasi/{pasien}', [DokterKonsultasiController::class, 'update'])->name('dokter.konsultasi.update');
});

// Grup Middleware untuk Pasien
Route::middleware(['auth:pasien'])->group(function () {
    // Dashboard
    // Route::get('/pasien/dashboard', [PasienDashboardController::class, 'index'])->name('pasien.dashboard');

    // Profil
    Route::get('/pasien/profil', [PasienProfilController::class, 'index'])->name('pasien.profil.index');
    Route::post('/profile/update', [PasienProfilController::class, 'updateProfile'])->name('pasien.profil.update');
    Route::post('/profile/update-password', [PasienProfilController::class, 'updatePassword'])->name('pasien.profil.update-password');

    // Riwayat
    Route::get('/pasien', function () {
        return redirect()->route('pasien.riwayat.index');
    });
    Route::get('/pasien/riwayat', [PasienRiwayatController::class, 'index'])->name('pasien.riwayat.index');
    Route::get('/pasien/get-jadwal/{poliId}', [PasienRiwayatController::class, 'getJadwal'])->name('pasien.get-jadwal');
    Route::post('/pasien/daftar-poli', [PasienRiwayatController::class, 'daftarPoli'])->name('pasien.daftar_poli');
    Route::get('/pasien/riwayat/detail/{id}', [PasienRiwayatController::class, 'detail'])->name('pasien.riwayat.detail');
    
    // Konsultasi
    Route::get('/pasien/konsultasi', [PasienKonsultasiController::class, 'index'])->name('pasien.konsultasi.index');
    Route::get('/pasies/konslutasi/create', [PasienKonsultasiController::class, 'create'])->name('pasien.konsultasi.create');
    Route::post('/pasies/konslutasi/store', [PasienKonsultasiController::class, 'store'])->name('pasien.konsultasi.store');
    Route::get('/pasies/konslutasi/edit/{id}', [PasienKonsultasiController::class, 'edit'])->name('pasien.konsultasi.edit');
    Route::put('/pasies/konslutasi/{pasien}', [PasienKonsultasiController::class, 'update'])->name('pasien.konsultasi.update');
    Route::delete('/pasies/konslutasi/{pasien}', [PasienKonsultasiController::class, 'destroy'])->name('pasien.konsultasi.destroy');

});
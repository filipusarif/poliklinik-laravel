<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarPoli extends Model
{
    use HasFactory, SoftDeletes;

    // Menentukan nama tabel jika berbeda dengan konvensi penamaan
    protected $table = 'daftar_poli';

    // Menentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'tgl_periksa',
        'keluhan',
        'no_antrian',
    ];

    /**
     * Relasi dengan model Pasien (One to One)
     * Satu daftar poli terkait dengan satu pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    /**
     * Relasi dengan model JadwalPraktik (One to One)
     * Satu daftar poli terkait dengan satu jadwal praktik
     */
    public function jadwalPraktik()
    {
        return $this->belongsTo(JadwalPraktik::class, 'id_jadwal', 'id');
    }

    /**
     * Relasi dengan model Periksa (One to One)
     * Satu daftar poli terkait dengan satu periksa
     */
    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}

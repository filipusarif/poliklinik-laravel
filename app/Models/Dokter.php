<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Authenticatable
{
    use HasFactory, SoftDeletes;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan
    protected $table = 'dokter';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'password',
        'id_poli',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Kolom yang harus di-hash, biasanya untuk password
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi dengan model Poli (One to One)
     * Dokter terkait dengan satu poli.
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }

    /**
     * Relasi dengan model JadwalPraktik (One to Many)
     * Dokter memiliki banyak jadwal praktik.
     */
    public function jadwalPraktik()
    {
        return $this->hasMany(JadwalPraktik::class, 'id_dokter', 'id');
    }
}

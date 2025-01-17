<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poli extends Model
{
    use HasFactory, SoftDeletes;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan (polis).
    protected $table = 'poli';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relasi dengan model Dokter (One to Many)
     * Satu poli bisa memiliki banyak dokter.
     */
    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli', 'id');
    }
}

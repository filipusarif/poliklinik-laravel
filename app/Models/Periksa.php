<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periksa extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'periksa';

    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relasi dengan model DaftarPoli (One to One)
     * Satu periksa terkait dengan satu daftar poli
     */
    public function daftar_poli()
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli', 'id');
    }

    /**
     * Relasi dengan model DetailPeriksa (One to Many)
     * Satu periksa terkait dengan banyak detail periksa
     */
    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}

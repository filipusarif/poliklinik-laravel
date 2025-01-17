<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPeriksa extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'detail_periksa';

    protected $fillable = [
        'id_periksa',
        'id_obat',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relasi dengan model Periksa (One to Many)
     * Satu detail periksa terkait dengan satu periksa
     */
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa', 'id');
    }

    /**
     * Relasi dengan model Obat (One to One)
     * Satu detail periksa terkait dengan satu obat
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }
}

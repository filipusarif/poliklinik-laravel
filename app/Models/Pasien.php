<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Authenticatable
{
    //
    use HasFactory, SoftDeletes;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan (polis).
    protected $table = 'pasien';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
        'password',
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Kolom yang harus di-hash, biasanya untuk password
    protected $hidden = [
        'remember_token',
        'password',
    ];
}

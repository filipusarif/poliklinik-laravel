<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'admin';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'password',
    ];

    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Kolom yang tidak boleh ditampilkan (misalnya password)
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

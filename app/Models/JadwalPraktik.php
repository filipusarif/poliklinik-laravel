<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class JadwalPraktik extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_praktik';

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Relasi dengan model Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    /**
     * Hitung durasi praktik dalam menit
     */
    public function getDurasiAttribute()
    {
        $mulai = Carbon::parse($this->jam_mulai);
        $selesai = Carbon::parse($this->jam_selesai);

        return $mulai->diffInMinutes($selesai);
    }

    /**
     * Hitung jumlah maksimal antrian (10 menit per pasien)
     */
    public function getMaxAntrianAttribute()
    {
        return floor($this->durasi / 10);
    }
}

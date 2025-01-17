<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Menyisipkan 15 data poli
        DB::table('poli')->insert([
            ['nama_poli' => 'Poli Umum', 'keterangan' => 'Pelayanan medis umum untuk pemeriksaan dasar.'],
            ['nama_poli' => 'Poli Anak', 'keterangan' => 'Pelayanan kesehatan untuk anak-anak.'],
            ['nama_poli' => 'Poli Gigi', 'keterangan' => 'Pelayanan kesehatan gigi dan mulut.'],
            ['nama_poli' => 'Poli Kandungan', 'keterangan' => 'Pelayanan medis untuk wanita hamil dan kelahiran.'],
            ['nama_poli' => 'Poli Mata', 'keterangan' => 'Pelayanan untuk pemeriksaan dan pengobatan mata.'],
            ['nama_poli' => 'Poli Kulit', 'keterangan' => 'Pelayanan medis untuk penyakit kulit dan kelamin.'],
            ['nama_poli' => 'Poli THT', 'keterangan' => 'Pelayanan medis untuk masalah telinga, hidung, dan tenggorokan.'],
            ['nama_poli' => 'Poli Bedah', 'keterangan' => 'Pelayanan medis untuk tindakan pembedahan.'],
            ['nama_poli' => 'Poli Penyakit Dalam', 'keterangan' => 'Pelayanan medis untuk penyakit dalam tubuh seperti diabetes dan hipertensi.'],
            ['nama_poli' => 'Poli Jantung', 'keterangan' => 'Pelayanan medis untuk penyakit jantung dan pembuluh darah.'],
            ['nama_poli' => 'Poli Paru', 'keterangan' => 'Pelayanan medis untuk penyakit paru-paru dan pernapasan.'],
            ['nama_poli' => 'Poli Rehabilitasi Medik', 'keterangan' => 'Pelayanan rehabilitasi fisik dan medis.'],
            ['nama_poli' => 'Poli Endokrin', 'keterangan' => 'Pelayanan medis untuk penyakit terkait kelenjar endokrin.'],
            ['nama_poli' => 'Poli Saraf', 'keterangan' => 'Pelayanan medis untuk masalah saraf dan neurologis.'],
            ['nama_poli' => 'Poli Gizi', 'keterangan' => 'Pelayanan medis untuk masalah gizi dan diet.']
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Menggunakan Faker untuk generate data acak
        $fakerLocale = env('APP_FAKER_LOCALE', 'id_ID'); // Default ke 'id_ID' untuk data Indonesia
        $faker = Faker::create($fakerLocale);

        // Tentukan jumlah data pasien yang akan dibuat
        $jumlahPasien = 15;

        for ($i = 1; $i <= $jumlahPasien; $i++) {
            // Ambil tahun dan bulan saat ini
            $tahun = Carbon::now()->year;
            $bulan = Carbon::now()->format('m'); // Bulan dalam dua digit

            // Hitung jumlah pasien yang sudah ada di database untuk tahun dan bulan ini
            $jumlahExisting = DB::table('pasien')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->count();

            // Urutan pasien untuk nomor rekam medis (No RM)
            $urutan = $jumlahExisting + 1;

            // Format No RM: tahun, bulan, diikuti urutan pasien
            $no_rm = sprintf('%d%s-%d', $tahun, $bulan, $urutan);

            // Insert data pasien ke tabel
            DB::table('pasien')->insert([
                'nama' => $faker->name, // Nama pasien
                'alamat' => $faker->address, // Alamat pasien
                'no_ktp' => $faker->unique()->numerify('################'), // No KTP 16 digit
                'no_hp' => '08' . $faker->unique()->numerify('##########'), // No HP dimulai dengan '08'
                'no_rm' => $no_rm, // No RM yang sesuai format
                'password' => Hash::make('12345678'), // Password default yang di-hash
                'created_at' => Carbon::now(), // Tanggal dan waktu saat ini
                'updated_at' => Carbon::now(), // Tanggal dan waktu saat ini
            ]);
        }
    }
}
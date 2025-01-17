<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $fakerLocale = env('APP_FAKER_LOCALE', 'en_US');
        $faker = Faker::create($fakerLocale);

        // Misalnya, ada 10 poli
        $totalPoli = 15;

        // Pertama, pastikan setiap poli mendapatkan satu dokter
        for ($i = 1; $i <= $totalPoli; $i++) {
            DB::table('dokter')->insert([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'no_hp' => '08' . $faker->unique()->numerify('##########'),
                'password' => Hash::make('12345678'),
                'id_poli' => $i, // Setiap poli mendapatkan satu dokter
            ]);
        }

        // Sekarang, tambahkan sisa dokter secara acak (25 - 10 = 15 dokter tambahan)
        $remainingDoctors = 15; // Total dokter yang harus didistribusikan setelah 1 dokter di setiap poli

        for ($i = 1; $i <= $remainingDoctors; $i++) {
            // Pilih poli secara acak
            DB::table('dokter')->insert([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'no_hp' => '08' . $faker->unique()->numerify('##########'),
                'password' => Hash::make('12345678'),
                'id_poli' => rand(1, $totalPoli), // Pilih poli secara acak dari yang tersedia
                'created_at' => Carbon::now(), // Tanggal dan waktu saat ini
                'created_at' => Carbon::now(), // Tanggal dan waktu saat ini
            ]);
        }
    }
}

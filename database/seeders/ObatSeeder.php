<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Menyisipkan 15 data obat ke tabel obat
        DB::table('obat')->insert([
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet',
                'harga' => 5000
            ],
            [
                'nama_obat' => 'Aspirin',
                'kemasan' => 'Tablet',
                'harga' => 7000
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'kemasan' => 'Kapsul',
                'harga' => 10000
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul',
                'harga' => 12000
            ],
            [
                'nama_obat' => 'Cetirizine',
                'kemasan' => 'Tablet',
                'harga' => 4500
            ],
            [
                'nama_obat' => 'Diphenhydramine',
                'kemasan' => 'Tablet',
                'harga' => 8000
            ],
            [
                'nama_obat' => 'Lorazepam',
                'kemasan' => 'Tablet',
                'harga' => 15000
            ],
            [
                'nama_obat' => 'Paracetamol Extra',
                'kemasan' => 'Tablet',
                'harga' => 6000
            ],
            [
                'nama_obat' => 'Omeprazole',
                'kemasan' => 'Kapsul',
                'harga' => 11000
            ],
            [
                'nama_obat' => 'Miconazole',
                'kemasan' => 'Krim',
                'harga' => 25000
            ],
            [
                'nama_obat' => 'Chlorpheniramine',
                'kemasan' => 'Tablet',
                'harga' => 4000
            ],
            [
                'nama_obat' => 'Prednisolone',
                'kemasan' => 'Tablet',
                'harga' => 9500
            ],
            [
                'nama_obat' => 'Loratadine',
                'kemasan' => 'Tablet',
                'harga' => 8500
            ],
            [
                'nama_obat' => 'Codeine',
                'kemasan' => 'Tablet',
                'harga' => 12000
            ],
            [
                'nama_obat' => 'Dexamethasone',
                'kemasan' => 'Tablet',
                'harga' => 13000
            ]
        ]);
    }
}

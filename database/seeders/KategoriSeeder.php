<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'kategori' => 'makanan berat',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'minuman',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('kategori')->insert($kategori);
    }
}

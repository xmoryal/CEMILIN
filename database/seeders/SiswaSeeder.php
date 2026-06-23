<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nama' => 'Ahmad',
            'kelas' => '11-A',
            'username' => 'ahmadgoku',
            'password' => Hash::make('ahmadgoku'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}

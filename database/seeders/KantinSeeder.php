<?php

namespace Database\Seeders;

use App\Models\Kantin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KantinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kantin::create([
            'nama_kantin' => 'kantin pak mulyo',
            'email' => 'mulyo@cemilin.com',
            'password' => Hash::make('mulyo123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

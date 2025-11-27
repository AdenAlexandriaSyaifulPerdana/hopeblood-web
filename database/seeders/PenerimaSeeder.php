<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PenerimaSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'wulan',
            'email' => 'wulan@gmail.com',
            'password' => Hash::make('wulan123'),
            'role' => 'penerima',
            'usia' => '20',
            'alamat' => 'Banyuwangi',
            'golongan_darah' => 'O'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PendonorSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Tia',
            'email' => 'tia@gmail.com',
            'password' => Hash::make('tia123'),
            'role' => 'pendonor',
            'usia' => '20',
            'alamat' => 'Banyuwangi',
            'golongan_darah' => 'O'
        ]);
    }
}

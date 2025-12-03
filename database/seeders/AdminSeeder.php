<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin UDD PMI Kabupaten Jember',
            'email' => 'pmi@gmail.com',
            'password' => Hash::make('pmi123'),
            'role' => 'admin',
            'hospital_id' => '1',
            'usia' => '20',
            'alamat' => 'Jl. Srikoyo No. 115, Patrang, Jember',
            'golongan_darah' => 'O A B AB'
        ]);

        User::create([
            'name' => 'RSD dr. Soebandi Jember',
            'email' => 'soebandi@gmail.com',
            'password' => Hash::make('soebandi123'),
            'role' => 'admin',
            'hospital_id' => '2',
            'usia' => '20',
            'alamat' => 'Jl. dr. Soebandi No. 124, Patrang, Jember',
            'golongan_darah' => 'O A B AB'
        ]);

        User::create([
            'name' => 'RSD Balung Jember',
            'email' => 'balung@gmail.com',
            'password' => Hash::make('balung123'),
            'role' => 'admin',
            'hospital_id' => '3',
            'usia' => '20',
            'alamat' => 'Jl. Rambipuji–Balung, Balung, Jember',
            'golongan_darah' => 'O A B AB'
        ]);

        User::create([
            'name' => 'Unit Donor Darah RS DKT Jember',
            'email' => 'dkt@gmail.com',
            'password' => Hash::make('dkt123'),
            'role' => 'admin',
            'hospital_id' => '4',
            'usia' => '20',
            'alamat' => 'Jl. PB Sudirman, Kepatihan, Jember',
            'golongan_darah' => 'O A B AB'
        ]);

        User::create([
            'name' => 'Klinik Pratama PMI Jember',
            'email' => 'pratama@gmail.com',
            'password' => Hash::make('pratama123'),
            'role' => 'admin',
            'hospital_id' => '5',
            'usia' => '20',
            'alamat' => 'Area sekitar Kantor PMI Jember',
            'golongan_darah' => 'O A B AB'
        ]);
    }
}

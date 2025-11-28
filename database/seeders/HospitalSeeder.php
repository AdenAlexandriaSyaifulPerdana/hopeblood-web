<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    public function run(): void
    {
        Hospital::insert([
            [
                'nama_rumah_sakit' => 'UDD PMI Kabupaten Jember',
                'alamat' => 'Jl. Srikoyo No. 115, Patrang, Jember',
                'jam_operasional' => '08.00 - 20.00',
                'nomer_hp' => '0812-3456-7811'
            ],
            [
                'nama_rumah_sakit' => 'RSD dr. Soebandi Jember',
                'alamat' => 'Jl. dr. Soebandi No. 124, Patrang, Jember',
                'jam_operasional' => '08.00 - 14.00',
                'nomer_hp' => '0813-8899-1274'
            ],
            [
                'nama_rumah_sakit' => 'RSD Balung Jember',
                'alamat' => 'Jl. Rambipuji–Balung, Balung, Jember',
                'jam_operasional' => '08.00 - 13.00',
                'nomer_hp' => '0852-3344-9901'
            ],
            [
                'nama_rumah_sakit' => 'Unit Donor Darah RS DKT Jember',
                'alamat' => 'Jl. PB Sudirman, Kepatihan, Jember',
                'jam_operasional' => '09.00 - 13.00',
                'nomer_hp' => '0813-5588-4412'
            ],
            [
                'nama_rumah_sakit' => 'Klinik Pratama PMI Jember',
                'alamat' => 'Area sekitar Kantor PMI Jember',
                'jam_operasional' => '08.00 - 12.00',
                'nomer_hp' => '0851-7766-4300'
            ],
        ]);
    }
}

<?php

namespace App\Models\pendonor;

use Illuminate\Database\Eloquent\Model;

class KonfirmasiDonor extends Model
{
    protected $table = 'konfirmasi_donor';

    protected $fillable = [
        'id_pendonor',
        'id_permohonan',
        'lokasi_donor',
        'tanggal_donor',
        'waktu_donor',
        'status'
    ];
}

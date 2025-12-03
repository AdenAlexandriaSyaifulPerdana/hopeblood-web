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

    public function permohonan()
    {
        return $this->belongsTo(\App\Models\penerima\PermohonanDarah::class, 'id_permohonan');
    }

    public function hospital()
    {
        return $this->belongsTo(\App\Models\Hospital::class, 'lokasi_donor');
    }

    public function pendonor()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_pendonor');
    }
}

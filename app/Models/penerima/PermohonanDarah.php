<?php

namespace App\Models\penerima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanDarah extends Model
{
    use HasFactory;

    protected $table = 'permohonan_darah';

    protected $fillable = [
        'id_penerima',
        'golongan_darah',
        'lokasi_rumah_sakit',
        'keterangan',
        'status',
    ];

    public function konfirmasiPendonor()
    {
        return $this->hasMany(\App\Models\pendonor\KonfirmasiDonor::class, 'id_permohonan');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_penerima');
    }

    public function hospital()
    {
        return $this->belongsTo(\App\Models\Hospital::class, 'lokasi_rumah_sakit');
    }
}

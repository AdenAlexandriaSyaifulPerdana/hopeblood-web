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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'jam_operasional',
        'nomer_hp'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitals extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'jam_operasional',
        'nomer_hp'
    ];
}

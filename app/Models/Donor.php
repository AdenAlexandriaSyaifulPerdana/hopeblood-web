<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    public function user(){ return $this->belongsTo(User::class); }
    public function histories(){ return $this->hasMany(DonorHistory::class); }
}

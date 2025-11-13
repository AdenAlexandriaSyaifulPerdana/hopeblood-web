<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    public function hospital(){ return $this->belongsTo(Hospital::class); }
    public function requester(){ return $this->belongsTo(User::class, 'user_id'); }
}

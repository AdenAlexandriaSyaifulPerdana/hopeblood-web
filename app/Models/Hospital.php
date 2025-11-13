<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function schedules(){ return $this->hasMany(Schedule::class); }
    public function requests(){ return $this->hasMany(BloodRequest::class); }
}

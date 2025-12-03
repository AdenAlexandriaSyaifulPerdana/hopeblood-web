<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /**
     * @property int $hospital_id
     */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'usia',
        'alamat',
        'golongan_darah',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

}

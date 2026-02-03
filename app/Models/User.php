<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'username',
        'no_telepon',
        'bidang',
        'password',
        'role',
        'reset_token',
        'reset_token_expires'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'reset_token'
    ];
    
    protected $casts = [
        'reset_token_expires' => 'datetime'
    ];
    
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Driver extends Authenticatable
{
    use HasFactory, Notifiable;
    
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function isAdmin()
    {
        return $this->is_admin;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

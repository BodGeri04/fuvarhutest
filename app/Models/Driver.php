<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
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
}

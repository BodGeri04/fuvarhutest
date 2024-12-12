<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
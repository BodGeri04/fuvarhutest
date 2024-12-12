<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    protected $fillable = [
        'brand',
        'type',
        'license_plate',
        'driver_id',
    ];
}

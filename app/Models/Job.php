<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
 
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
       
    protected $fillable = [
        'starting_address',
        'destination_address',
        'recipient_name',
        'recipient_phone',
        'status',
        'driver_id',
    ];
}

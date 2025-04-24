<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trains extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'departure_time',
        'origin',
        'destination',
        'economy_price',
        'executive_price',
        'seats_available'
    ];
}

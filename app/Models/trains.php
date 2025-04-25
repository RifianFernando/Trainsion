<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trains extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'train_image',
        'description',
        'departure_time',
        'origin_train_station_id',
        'destination_train_station_id',
        'economy_price',
        'executive_price',
        'seats_available'
    ];
}

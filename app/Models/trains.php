<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // https://laravel.com/docs/10.x/eloquent-relationships#one-to-many-inverse
    public function originTrainStation(): BelongsTo
    {
        return $this->belongsTo(TrainStation::class);
    }

    public function destinationTrainStation(): BelongsTo
    {
        return $this->belongsTo(TrainStation::class);
    }
}

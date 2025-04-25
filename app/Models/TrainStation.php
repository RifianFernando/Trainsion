<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainStation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    // https://laravel.com/docs/10.x/eloquent-relationships#one-to-many
    public function train(): HasMany
    {
        return $this->hasMany(trains::class);
    }
}

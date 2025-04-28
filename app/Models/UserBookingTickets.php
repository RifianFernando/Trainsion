<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBookingTickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'train_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function train(): BelongsTo
    {
        return $this->belongsTo(trains::class);
    }

    public function bookingTickets()
    {
        return $this->hasMany(BookingTicket::class, 'user_booking_ticket_id');
    }

    public function paymentTickets()
    {
        return $this->hasOne(TicketPayment::class, 'user_booking_ticket_id');
    }
}

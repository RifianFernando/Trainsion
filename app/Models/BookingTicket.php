<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'class',
        'user_booking_ticket_id'
    ];

    public function userBookingTicket()
    {
        return $this->belongsTo(UserBookingTickets::class, 'user_booking_ticket_id');
    }
}

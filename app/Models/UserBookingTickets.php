<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookingTickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'train_id',
    ];

    public function bookingTickets()
    {
        return $this->hasMany(BookingTicket::class, 'user_booking_ticket_id');
    }

    public function paymentTickets()
    {
        return $this->hasMany(TicketPayment::class, 'user_booking_ticket_id');
    }
}

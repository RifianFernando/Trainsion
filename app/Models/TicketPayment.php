<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TicketPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_proof_img',
        'status',
        'user_booking_ticket_id'
    ];

    public function userBookingTicket()
    {
        return $this->hasOne(UserBookingTickets::class);
    }

    // https://laravel.com/docs/10.x/eloquent-mutators
    public function getPaymentProofImgAttribute($value)
    {
        return $value ? url(Storage::url($value)) : null;
    }
}

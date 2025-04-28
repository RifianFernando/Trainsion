<?php

namespace App\Services\BookingTicket;

use LaravelEasyRepository\BaseService;

interface BookingTicketService extends BaseService
{

    // Write something awesome :)
    public function getUserSessionBookingTicket($user);

    public function getAllBookingTicketUser();

    public function getUserSessionBookingTicketByID($btID, $user);

    public function createBookingTicket($request, $user);

    public function sendConfirmationPaymentEmailBookingTicket($user);
}

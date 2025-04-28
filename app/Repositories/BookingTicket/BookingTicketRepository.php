<?php

namespace App\Repositories\BookingTicket;

use LaravelEasyRepository\Repository;

interface BookingTicketRepository extends Repository
{

    // Write something awesome :)
    public function getUserSessionBookingTicket($user);

    public function getUserSessionBookingTicketByID($btID, $user);

    public function createBookingTicket($user);
}

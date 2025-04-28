<?php

namespace App\Repositories\TicketPayment;

use LaravelEasyRepository\Repository;

interface TicketPaymentRepository extends Repository{

    // Write something awesome :)
    public function payBookingTicketByID($data, $uid);
}

<?php

namespace App\Repositories\TicketPayment;

use LaravelEasyRepository\Repository;

interface TicketPaymentRepository extends Repository{

    // Write something awesome :)
    public function payBookingTicketByID($data, $uid);

    public function cancelBookingTicketByID($data, $uid);

    public function handleRejectAndAcceptPaymentStatus($tid, $status);
}

<?php

namespace App\Services\Ticket\PaymentBookingTicket;

use LaravelEasyRepository\BaseService;

interface PaymentBookingTicketService extends BaseService{

    // Write something awesome :)
    public function payBookingTicketByID($request, $user);

    public function cancelBookingTicketByID($user, $tid);

    public function handleRejectAndAcceptPaymentStatus($tid, $status);
}

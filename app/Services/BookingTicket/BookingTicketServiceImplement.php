<?php

namespace App\Services\BookingTicket;

use LaravelEasyRepository\Service;
use App\Repositories\BookingTicket\BookingTicketRepository;

class BookingTicketServiceImplement extends Service implements BookingTicketService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(BookingTicketRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}

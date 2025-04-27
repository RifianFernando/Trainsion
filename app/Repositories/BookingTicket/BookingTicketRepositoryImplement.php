<?php

namespace App\Repositories\BookingTicket;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\BookingTicket;

class BookingTicketRepositoryImplement extends Eloquent implements BookingTicketRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(BookingTicket $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}

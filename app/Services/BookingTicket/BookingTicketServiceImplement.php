<?php

namespace App\Services\BookingTicket;

use App\Http\Requests\BookingTicketRequest;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\BookingTicket\BookingTicketRepository;

class BookingTicketServiceImplement extends ServiceApi implements BookingTicketService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "Booking Train";
    protected $create_message = "successfully created";
    protected $update_message = "successfully updated";
    protected $delete_message = "successfully deleted";

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */

    public function __construct(BookingTicketRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
    public function createBookingTicket($request, $user)
    {
        try {
            $data = [
                "user_id" => $user->id,
                "train_id" => $request->trainID
            ];
            $data['user'] = $request->userData;
            return $this->mainRepository->createBookingTicket($data, $user);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}

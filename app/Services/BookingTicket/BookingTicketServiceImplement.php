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

    public function getUserSessionBookingTicket($user)
    {
        try {
            $result = $this->mainRepository->getUserSessionBookingTicket($user);

            return $this
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getUserSessionBookingTicketByID($btID, $user)
    {
        try {
            $result = $this->mainRepository->getUserSessionBookingTicketByID($btID, $user);

            return $this
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
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
            $result = $this->mainRepository->createBookingTicket($data);

            return $this
                ->setMessage($this->create_message)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}

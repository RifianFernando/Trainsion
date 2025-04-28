<?php

namespace App\Services\BookingTicket;

use App\Http\Requests\BookingTicketRequest;
use App\Mail\SendMail;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\BookingTicket\BookingTicketRepository;
use Illuminate\Support\Facades\Mail;

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
    protected $title = "Booking Ticket";
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

    public function getAllBookingTicketUser()
    {
        try {
            $result = $this->mainRepository->getAllBookingTicketUser();

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

    public function sendConfirmationPaymentEmailBookingTicket($user)
    {
        try {
            $data = [
                'name' => $user['name'],
                'email' => $user['email'],
                'subject' => 'U already paid the ticket of the booking ticket',
                'message' => 'success'
            ];
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SendMail($data));

            return [
                'status' => 200,
                'message' => 'Confirmation email sent successfully'
            ];
        } catch (\Exception $exception) {
            // Return error info
            return [
                'status' => 500,
                'message' => 'Failed to send email',
                'error' => $exception->getMessage()
            ];
        }
    }
}

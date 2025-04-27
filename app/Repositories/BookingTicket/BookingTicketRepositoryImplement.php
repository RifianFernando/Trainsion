<?php

namespace App\Repositories\BookingTicket;

use App\Models\BookingTicket;
use App\Models\TicketPayment;
use App\Models\UserBookingTickets;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\ServiceApi;

class BookingTicketRepositoryImplement extends ServiceApi implements BookingTicketRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $bookingTicket;
    protected $userBookingTicket;
    protected $ticketPayment;

    public function __construct(
        BookingTicket $bookingTicket,
        UserBookingTickets $userBookingTicket,
        TicketPayment $ticketPayment
    )
    {
        $this->bookingTicket = $bookingTicket;
        $this->userBookingTicket = $userBookingTicket;
        $this->ticketPayment = $ticketPayment;
    }

    // Write something awesome :)
    public function createBookingTicket($data)
    {
        try {
            DB::beginTransaction();

            $userBookingTicket = $this->userBookingTicket->create([
                'user_id' => $data->user_id,
                'train_id' => $data->train_id,
            ]);
            foreach ($data->user as $user) {
                $this->bookingTicket->create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->email,
                    'class' => $user->class,
                    'user_booking_ticket_id' => $userBookingTicket->id
                ]);
            }

            $this->ticketPayment->create([
                // TODO: add store file like create train for at the payment service
                'payment_proof_img' => 'filenya apaa',
                'user_booking_ticket_id' => $userBookingTicket->id
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->exceptionResponse($exception);
        }
    }
}

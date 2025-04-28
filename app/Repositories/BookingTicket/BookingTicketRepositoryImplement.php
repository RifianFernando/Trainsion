<?php

namespace App\Repositories\BookingTicket;

use App\Models\BookingTicket;
use App\Models\TicketPayment;
use App\Models\trains;
use App\Models\UserBookingTickets;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class BookingTicketRepositoryImplement extends Eloquent implements BookingTicketRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $bookingTicket;
    protected $userBookingTicket;
    protected $ticketPayment;
    protected $train;

    public function __construct(
        BookingTicket $bookingTicket,
        UserBookingTickets $userBookingTicket,
        TicketPayment $ticketPayment,
        trains $train
    ) {
        $this->bookingTicket = $bookingTicket;
        $this->userBookingTicket = $userBookingTicket;
        $this->ticketPayment = $ticketPayment;
        $this->train = $train;
    }

    // Write something awesome :)
    public function getUserSessionBookingTicket($user)
    {
        $result = $this->userBookingTicket->with([
            'paymentTickets',
            'bookingTickets',
            'train',
            'train.originTrainStation',
            'train.destinationTrainStation'
        ])->where(
            'user_id',
            $user['id']
        )->get();

        return $result;
    }

    // Write something awesome :)
    public function getUserSessionBookingTicketByID($btID, $user)
    {
        $result = $this->userBookingTicket->with([
            'paymentTickets',
            'bookingTickets',
            'train',
            'train.originTrainStation',
            'train.destinationTrainStation'
        ])->findOrFail($btID);

        return $result;
    }

    public function createBookingTicket($data)
    {
        try {
            DB::beginTransaction();

            $userBookingTicket = $this->userBookingTicket->create([
                'user_id' => $data['user_id'],
                'train_id' => $data['train_id'],
            ]);

            $totalSeat = 0;
            foreach ($data['user'] as $user) {
                $this->bookingTicket->create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                    'class' => $user['class'],
                    'user_booking_ticket_id' => $userBookingTicket['id']
                ]);
                $totalSeat++;
            }

            $train = $this->train->findOrFail($data['train_id']);
            $train->updateOrFail([
                'seats_available' => $train->seats_available - $totalSeat
            ]);

            $this->ticketPayment->create([
                'user_booking_ticket_id' => $userBookingTicket->id
            ]);
            DB::commit();

            return $userBookingTicket;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }
}

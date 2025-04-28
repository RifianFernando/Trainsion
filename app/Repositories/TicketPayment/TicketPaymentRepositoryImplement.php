<?php

namespace App\Repositories\TicketPayment;

use App\Models\BookingTicket;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TicketPayment;
use App\Models\UserBookingTickets;
use Illuminate\Support\Facades\DB;

class TicketPaymentRepositoryImplement extends Eloquent implements TicketPaymentRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;
    protected $userBookingTicket;
    protected $bookingTicket;

    public function __construct(
        TicketPayment $model,
        UserBookingTickets $userBookingTicket,
        BookingTicket $bookingTicket
    ) {
        $this->model = $model;
        $this->userBookingTicket = $userBookingTicket;
        $this->bookingTicket = $bookingTicket;
    }

    // Write something awesome :)

    public function payBookingTicketByID($data, $uid)
    {
        try {
            DB::beginTransaction();
            $userTicket = $this->model->findOrFail($data['payment_tickets_id']);
            $result = $userTicket->updateOrFail([
                'status' => 'Pending',
                'payment_proof_img' => $data['payment_proof_img']
            ]);

            DB::commit();

            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function cancelBookingTicketByID($user, $tid)
    {
        try {
            DB::beginTransaction();

            $searchTicket = $this->userBookingTicket
                ->with(['paymentTickets', 'bookingTickets'])
                ->where('id', $tid)
                ->where('user_id', $user['id'])
                ->firstOrFail();

            foreach ($searchTicket->bookingTickets as $bid) {
                $this->bookingTicket->findOrFail($bid->id)->delete();
            }

            $this->model->findOrFail($searchTicket->paymentTickets->id)->delete();

            $searchTicket->delete();


            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }
}

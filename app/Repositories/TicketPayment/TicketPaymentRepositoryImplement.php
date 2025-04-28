<?php

namespace App\Repositories\TicketPayment;

use App\Models\BookingTicket;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TicketPayment;
use App\Models\trains;
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
    protected $train;

    public function __construct(
        TicketPayment $model,
        UserBookingTickets $userBookingTicket,
        BookingTicket $bookingTicket,
        trains $train
    ) {
        $this->model = $model;
        $this->train = $train;
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
                ->with(['paymentTickets', 'bookingTickets', 'train'])
                ->where('id', $tid)
                ->where('user_id', $user['id'])
                ->firstOrFail();

            $seatsUpdateTotal = 0;
            foreach ($searchTicket->bookingTickets as $bid) {
                $this->bookingTicket->findOrFail($bid->id)->delete();
                $seatsUpdateTotal++;
            }

            $this->train->findOrFail($searchTicket->train->id)->update([
                'seats_available' => $searchTicket->train->seats_available + $seatsUpdateTotal
            ]);

            $this->model->findOrFail($searchTicket->paymentTickets->id)->delete();

            $searchTicket->delete();


            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function handleRejectAndAcceptPaymentStatus($tid, $status)
    {
        try {
            DB::beginTransaction();

            $ticket = $this->model->findOrFail($tid);

            $ticket->update([
                'status' => $status == 'accept' ? 'Paid' : 'Cancelled'
            ]);

            DB::commit();
            return $ticket;
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}

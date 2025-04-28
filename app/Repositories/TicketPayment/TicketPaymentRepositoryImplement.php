<?php

namespace App\Repositories\TicketPayment;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TicketPayment;
use Illuminate\Support\Facades\DB;

class TicketPaymentRepositoryImplement extends Eloquent implements TicketPaymentRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(TicketPayment $model)
    {
        $this->model = $model;
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
}

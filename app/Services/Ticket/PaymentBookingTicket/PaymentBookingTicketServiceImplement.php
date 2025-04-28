<?php

namespace App\Services\Ticket\PaymentBookingTicket;

use App\Repositories\TicketPayment\TicketPaymentRepository;
use LaravelEasyRepository\ServiceApi;

class PaymentBookingTicketServiceImplement extends ServiceApi implements PaymentBookingTicketService
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
    protected $title = "Payment Ticket";
    protected $create_message = "successfully created";
    protected $update_message = "successfully updated";
    protected $delete_message = "successfully deleted";

    public function __construct(TicketPaymentRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    private function uploadFile($data, $file_name)
    {
        $removeAllWhiteSpaceRegex = '/\s+/';
        $file_name = preg_replace($removeAllWhiteSpaceRegex, '', $file_name);

        $removeSpecialCharRegex = '/[@#$%^&*><`~()}{|":;?\/.,]/';
        $file_name = preg_replace($removeSpecialCharRegex, '', $file_name);

        $extension = $data->getClientOriginalExtension();
        $fileWithExtension = $file_name . "_" . (date("YmdHis", time())) . '.' . $extension;
        $path = $data->storeAs('/public/image/payment', $fileWithExtension);
        $data->move(public_path() . '/storage/image/payment', $fileWithExtension);

        return $path;
    }
    // Define your custom methods :)

    public function payBookingTicketByID($request, $user)
    {
        try {
            $fileName =
                $request->has('payment_proof_img')
                ? $this->uploadFile(
                    $request->file('payment_proof_img'),
                    $user->name
                )
                : null;
            $data = [
                'payment_proof_img' => $fileName,
                'payment_tickets_id' => $request->payment_tickets_id
            ];
            $result = $this->mainRepository->payBookingTicketByID($data, $user['id']);

            return $this
                ->setMessage($this->title . '' . $this->update_message)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function cancelBookingTicketByID($user, $tid)
    {
        try {
            $result = $this->mainRepository->cancelBookingTicketByID($user, $tid);
            return $this
                ->setMessage($this->title . '' . $this->delete_message)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getAllBookingTicketUser($user, $tid)
    {
        try {
            $result = $this->mainRepository->cancelBookingTicketByID($user, $tid);
            return $this
                ->setMessage($this->title . '' . $this->delete_message)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function handleRejectAndAcceptPaymentStatus($tid, $status)
    {
        try {
            $result = $this->mainRepository->handleRejectAndAcceptPaymentStatus($tid, $status);
            return $this
                ->setMessage($this->title .' '. $this->delete_message)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}

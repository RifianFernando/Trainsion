<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBookingTicketRequest;
use App\Services\Ticket\PaymentBookingTicket\PaymentBookingTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketPaymentController extends Controller
{
    protected $paymentBookingTicketService;

    public function __construct(PaymentBookingTicketService $paymentBookingTicketService)
    {
        $this->paymentBookingTicketService = $paymentBookingTicketService;
    }
    /**
     * upload payment proof
     */
    public function payBookingTicket(PaymentBookingTicketRequest $request): JsonResponse
    {
        $user = auth()->user();
        return $this->paymentBookingTicketService->payBookingTicketByID($request, $user)->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tid)
    {
        $user = auth()->user();

        return $this->paymentBookingTicketService->cancelBookingTicketByID($user, $tid)->toJson();
    }

    /**
     * handle Reject AndA ccept Payment Status
     */
    public function handleRejectAndAcceptPaymentStatus(Request $request, $tid)
    {
        $status = $request->type;
        return $this->paymentBookingTicketService->handleRejectAndAcceptPaymentStatus($tid, $status)->toJson();
    }
}

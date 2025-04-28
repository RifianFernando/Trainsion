<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBookingTicketRequest;
use App\Services\BookingTicket\BookingTicketService;
use App\Services\Ticket\PaymentBookingTicket\PaymentBookingTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketPaymentController extends Controller
{
    protected $paymentBookingTicketService;
    protected $bookingTicketService;

    public function __construct(
        PaymentBookingTicketService $paymentBookingTicketService,
        BookingTicketService $bookingTicketService
    )
    {
        $this->paymentBookingTicketService = $paymentBookingTicketService;
        $this->bookingTicketService = $bookingTicketService;
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
        $user = $this->paymentBookingTicketService->handleRejectAndAcceptPaymentStatus($tid, $status);
        $result = $this->bookingTicketService->sendConfirmationPaymentEmailBookingTicket($user);

        return response()->json($result, $result['status']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentBookingTicketRequest;
use App\Models\TicketPayment;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketPayment $ticketPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketPayment $ticketPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketPayment $ticketPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPayment $ticketPayment)
    {
        //
    }
}

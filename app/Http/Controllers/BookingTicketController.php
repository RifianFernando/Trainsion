<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingTicketRequest;
use App\Models\BookingTicket;
use App\Services\BookingTicket\BookingTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingTicketController extends Controller
{
    protected $bookingTicketService;

    public function __construct(BookingTicketService $bookingTicketService)
    {
        $this->bookingTicketService = $bookingTicketService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        return $this->bookingTicketService->getUserSessionBookingTicket($user)->toJson();
    }
    /**
     * Display a listing of the all user resource.
     */
    public function adminIndex(): JsonResponse
    {
        return $this->bookingTicketService->getAllBookingTicketUser()->toJson();
    }

    /**
     * Get BookingTicketByID
     */
    public function getUserSessionBookingTicketByID($btID): JsonResponse
    {
        $user = Auth::user();
        return $this->bookingTicketService->getUserSessionBookingTicketByID($btID, $user)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BookingTicketRequest $request): JsonResponse
    {
        $user = Auth::user();
        return $this->bookingTicketService->createBookingTicket($request, $user)->toJson();
    }

    /**
     * Update BookingTrain.
     */
    // public function update(BookingTrainRequest $request, $trainID): JsonResponse
    // {
    //     return $this->bookingTicketService->updateBookingTrain($request, $trainID)->toJson();
    // }

    /**
     * Delete Booking Train
     */
    // public function destroy($trainID): JsonResponse
    // {
    //     return $this->bookingTicketService->deleteTrain($trainID)->toJson();
    // }
}

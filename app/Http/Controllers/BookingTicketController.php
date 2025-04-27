<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingTicketRequest;
use App\Models\BookingTicket;
use App\Services\BookingTicket\BookingTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingTicketController extends Controller
{
    protected $bookingTrainService;

    public function __construct(BookingTicketService $bookingTrainService)
    {
        $this->bookingTrainService = $bookingTrainService;
    }
    /**
     * Display a listing of the resource.
     */
    // public function index(): JsonResponse
    // {
    //     return $this->bookingTrainService->getTrain()->toJson();
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BookingTicketRequest $request): JsonResponse
    {
        return $this->bookingTrainService->createBookingTicket($request)->toJson();
    }

    /**
     * Get BookingTrainByID
     */
    // public function getBookingTrainByID($trainID): JsonResponse
    // {
    //     return $this->bookingTrainService->getTrainByID($trainID)->toJson();
    // }

    /**
     * Update BookingTrain.
     */
    // public function update(BookingTrainRequest $request, $trainID): JsonResponse
    // {
    //     return $this->bookingTrainService->updateBookingTrain($request, $trainID)->toJson();
    // }

    /**
     * Delete Booking Train
     */
    // public function destroy($trainID): JsonResponse
    // {
    //     return $this->bookingTrainService->deleteTrain($trainID)->toJson();
    // }
}

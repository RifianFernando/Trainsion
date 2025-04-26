<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingTrainRequest;
use App\Services\Train\BookingTrain\BookingTrainService;
use Illuminate\Http\JsonResponse;

class BookingTrainController extends Controller
{
    protected $bookingTrainService;

    public function __construct(BookingTrainService $bookingTrainService)
    {
        $this->bookingTrainService = $bookingTrainService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->bookingTrainService->getTrain()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BookingTrainRequest $request): JsonResponse
    {
        return $this->bookingTrainService->createBookingTrain($request)->toJson();
    }

    /**
     * Get BookingTrainByID
     */
    public function getBookingTrainByID($trainID): JsonResponse
    {
        return $this->bookingTrainService->getTrainByID($trainID)->toJson();
    }

    /**
     * Delete Booking Train
     */
    public function destroy($trainID): JsonResponse
    {
        return $this->bookingTrainService->deleteTrain($trainID)->toJson();
    }
}

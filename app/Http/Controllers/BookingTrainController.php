<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingTrainRequest;
use App\Services\Train\BookingTrain\BookingTrainService;
// use Illuminate\Http\Request;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BookingTrainRequest $request): JsonResponse
    {
        return $this->bookingTrainService->createBookingTrain($request)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingTrainRequest $request)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TrainStation;
use App\Services\Train\TrainStation\TrainStationService;
use Illuminate\Http\Request;

class TrainStationController extends Controller
{
    protected $trainStationService;

    public function __construct(TrainStationService $trainStationService) {
        $this->trainStationService = $trainStationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->trainStationService->getListStation()->toJson();
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
    public function show(TrainStation $trainStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainStation $trainStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainStation $trainStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainStation $trainStation)
    {
        //
    }
}

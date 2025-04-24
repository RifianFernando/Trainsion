<?php

namespace App\Services\Train\BookingTrain;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Train\TrainRepository;

class BookingTrainServiceImplement extends ServiceApi implements BookingTrainService
{
    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "Booking Train";
    protected $create_message = "successfully created";
    protected $update_message = "successfully updated";
    protected $delete_message = "successfully deleted";
     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(TrainRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)

    public function createTrain($request)
    {
        try {
            return $this->mainRepository->createTrain($request);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getTrainByID($structureId)
    {
        try {
            return $this->mainRepository->getTrainById($structureId);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getTrain()
    {
        try {
            return $this->mainRepository->getTrains();
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function updateTrain($request, $structureId)
    {
        try {
            return $this->mainRepository->updateTrain($structureId, $request);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function deleteTrain($structureId)
    {
        try {
            return $this->mainRepository->deleteTrain($structureId);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}

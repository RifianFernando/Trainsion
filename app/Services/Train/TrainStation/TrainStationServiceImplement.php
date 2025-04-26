<?php

namespace App\Services\Train\TrainStation;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\TrainStation\TrainStationRepository;

class TrainStationServiceImplement extends ServiceApi implements TrainStationService{
    protected $mainRepository;

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

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */

    public function __construct(TrainStationRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getListStation()
    {
        try {
            $result = $this->mainRepository->getListStation();
            return $this
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    // Define your custom methods :)
}

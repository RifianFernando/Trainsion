<?php

namespace App\Repositories\TrainStation;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TrainStation;

class TrainStationRepositoryImplement extends Eloquent implements TrainStationRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(TrainStation $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
    public function getListStation()
    {
        return $this->model->all();
    }
}

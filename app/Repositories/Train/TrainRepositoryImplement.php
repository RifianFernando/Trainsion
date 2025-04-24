<?php

namespace App\Repositories\Train;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\trains;

class TrainRepositoryImplement extends Eloquent implements TrainRepository
{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(trains $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
    public function createTrain($trainData)
    {
        return $this->model->create($trainData);
    }

    public function updateTrain($trainId, $trainData)
    {
        $train = $this->model->find($trainId);
        if ($train) {
            $train->update($trainData);
            return $train;
        }
        return null;
    }

    public function deleteTrain($trainId)
    {
        $train = $this->model->find($trainId);
        if ($train) {
            $train->delete();
            return true;
        }
        return false;
    }

    public function getTrainById($trainId)
    {
        return $this->model->find($trainId);
    }

    public function getTrains()
    {
        return $this->model->all();
    }
}

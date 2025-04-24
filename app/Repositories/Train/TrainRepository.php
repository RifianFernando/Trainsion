<?php

namespace App\Repositories\Train;

use LaravelEasyRepository\Repository;

interface TrainRepository extends Repository
{
    public function createTrain($trainData);

    public function updateTrain($trainId, $trainData);

    public function deleteTrain($trainId);

    public function getTrainById($trainId);

    public function getTrains();
}

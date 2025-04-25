<?php

namespace App\Services\Train\BookingTrain;

use LaravelEasyRepository\BaseService;

interface BookingTrainService extends BaseService{

    public function createBookingTrain($request);

    public function getTrainByID($structureId);

    public function getTrain();

    public function updateTrain($request, $structureId);

    public function deleteTrain($structureId);

    public function uploadFile($data, $file_name);
}

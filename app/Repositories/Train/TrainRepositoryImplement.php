<?php

namespace App\Repositories\Train;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\trains;
use Illuminate\Support\Facades\Storage;

class TrainRepositoryImplement extends Eloquent implements TrainRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $train;

    public function __construct(trains $train)
    {
        $this->train = $train;
    }

    // Write something awesome :)
    public function createBookingTrain($trainData)
    {
        return $this->train->create($trainData);
    }

    public function getTrains()
    {
        $result = $this
            ->train
            ->with([
                'originTrainStation',
                'destinationTrainStation'
            ])
            ->get();

        // https: //laravel.com/docs/10.x/collections#available-methods
        $modifiedResult = $result->map(function ($train) {
            if ($train->train_image) {
                $train->train_image = url(Storage::url($train->train_image));
            }
            return $train;
        });

        return $modifiedResult;
    }

    public function updateTrain($trainId, $trainData)
    {
        $train = $this->train->find($trainId);
        if ($train) {
            $train->update($trainData);
            return $train;
        }
        return null;
    }

    public function deleteTrain($trainId)
    {
        $train = $this->train->find($trainId);
        if ($train) {
            $train->delete();
            return true;
        }
        return false;
    }

    public function getTrainById($trainId)
    {
        return $this->train->find($trainId);
    }
}

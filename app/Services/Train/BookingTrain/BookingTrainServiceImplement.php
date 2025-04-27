<?php

namespace App\Services\Train\BookingTrain;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Train\TrainRepository;
use Illuminate\Support\Facades\Storage;

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
    protected $trainRepository;

    public function __construct(TrainRepository $trainRepository)
    {
        $this->trainRepository = $trainRepository;
    }

    public function uploadFile($data, $file_name)
    {
        $removeAllWhiteSpaceRegex = '/\s+/';
        $file_name = preg_replace($removeAllWhiteSpaceRegex, '', $file_name);

        $removeSpecialCharRegex = '/[@#$%^&*><`~()}{|":;?\/.,]/';
        $file_name = preg_replace($removeSpecialCharRegex, '', $file_name);

        $extension = $data->getClientOriginalExtension();
        $fileWithExtension = $file_name . "_" . (date("YmdHis", time())) . '.' . $extension;
        $path = $data->storeAs('/public/image/train', $fileWithExtension);
        $data->move(public_path() . '/storage/image/train', $fileWithExtension);

        return $path;
    }

    // Define your custom methods :)

    public function createBookingTrain($request)
    {
        try {
            $fileName =
                $request->has('train_image')
                ? $this->uploadFile(
                    $request->file('train_image'),
                    $request->name
                )
                : null;
            $trainData = [
                'name' => $request->name,
                'train_image' => $fileName,
                'description' => $request->description,
                'departure_time' => $request->departure_time,
                'origin_train_station_id' => $request->origin_train_station_id,
                'destination_train_station_id' => $request->destination_train_station_id,
                'economy_price' => $request->economy_price,
                'executive_price' => $request->executive_price,
                'seats_available' => $request->seats_available
            ];

            $result = $this->trainRepository->createBookingTrain($trainData);
            return $this
                ->setMessage($this->title . " " . $this->create_message)
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getTrain()
    {
        try {
            $result = $this->trainRepository->getTrains();
            return $this
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getTrainByID($trainID)
    {
        try {
            $result = $this->trainRepository->getTrainById($trainID);
            return $this
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }


    public function updateBookingTrain($request, $trainId)
    {
        try {
            $train = $this->trainRepository->getTrainById($trainId);
            Storage::delete($train->train_image);
            $fileName =
                $request->has('train_image')
                ? $this->uploadFile($request->file('train_image'), $request->name)
                : null;
            $trainData = [
                'name' => $request->name,
                'train_image' => $fileName,
                'description' => $request->description,
                'departure_time' => $request->departure_time,
                'origin_train_station_id' => $request->origin_train_station_id,
                'destination_train_station_id' => $request->destination_train_station_id,
                'economy_price' => $request->economy_price,
                'executive_price' => $request->executive_price,
                'seats_available' => $request->seats_available
            ];
            $result = $this->trainRepository->updateBookingTrain($trainData, $trainId);
            return $this
                ->setMessage(
                    $this->title . " " . $this->create_message
                )
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function deleteTrain($structureId)
    {
        try {
            $this->trainRepository->deleteTrain($structureId);
            return $this
                ->setMessage($this->title . " " . $this->delete_message)
                ->setStatus(true)
                ->setCode(200);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}

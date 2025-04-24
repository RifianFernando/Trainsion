<?php

namespace App\Services\History;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\History\HistoryRepository;
use Illuminate\Support\Facades\Storage;

class HistoryServiceImplement extends ServiceApi implements HistoryService{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "History";
    protected $create_message = "Successfuly created!";
    protected $update_message = "Successfuly updated!";
    protected $delete_message = "Successfuly deleted!";
    protected $search_message = "Found";

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function createHistory($request)
    {
        try{
            $file_name = $request->history_year;
            $file = $request->has('history_image') ? $this->uploadFile($request->file('history_image'), $file_name) : null;
            $historyData = [
                'history_year' => $request->history_year,
                'history_description' => $request->history_description,
                'history_image' => $file,
            ];
            $result = $this->historyRepository->createHistory($historyData);
            return $this->setMessage($this->title." ".$this->create_message)->setStatus(true)->setCode(200)->setResult($result);
        }catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }


    public function updateHistory($request, $historyId)
    {
        try{
            $history = $this->getHistoryById($historyId);
            Storage::delete($history->history_image);
            $file_name = $request->history_year;
            $file = $request->has('history_image') ? $this->uploadFile($request->file('history_image'), $file_name) : null;
            $historyData = [
                'history_year' => $request->history_year,
                'history_description' => $request->history_description,
                'history_image' => $file
            ];
            $result = $this->historyRepository->updateHistory($historyData, $historyId);
            return $this->setMessage($this->title." ".$this->update_message)->setStatus(true)->setCode(200)->setResult($result);

        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function uploadFile($data, $file_name)
    {
        $file_name = preg_replace('/\s+/', '', $file_name);
        $pattern = '/[@#$%^&*><`~()}{|":;?\/.,]/';
        $file_name = preg_replace($pattern, '', $file_name);
        $extension = $data->getClientOriginalExtension();
        $fileWithExtension = $file_name . "_" . (date("YmdHis", time())) . '.' . $extension;
        $path = $data->storeAs('/public/image/history', $fileWithExtension);
        $data->move(public_path() . '/storage/image/history', $fileWithExtension);
        return $path;
    }

    public function deleteHistory($historyId)
    {
        try{
            $history = $this->getHistoryById($historyId);
            Storage::delete($history->history_image);
            $result = $this->historyRepository->deleteHistory($historyId);
            return $this->setMessage($this->title." ".$this->delete_message)->setStatus(true)->setCode(200)->setResult($result);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getHistoryById($historyId)
    {
        try{
            return $this->historyRepository->getHistoryById($historyId);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getHistories()
    {
        try{
            return $this->historyRepository->getHistories();
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function searchHistory($request)
    {
        try{
            $result = $request->input('search');
            $searchResult = $this->historyRepository->searchHistory($result);
            return $this->setMessage($this->search_message)->setStatus(true)->setCode(200)->setResult($searchResult);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function countHistory()
    {
        try{
            $count = $this->historyRepository->countHistory();
            return $this->setStatus(true)->setCode(200)->setResult($count);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }
}

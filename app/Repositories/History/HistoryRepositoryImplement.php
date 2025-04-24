<?php

namespace App\Repositories\History;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\History;
use Illuminate\Support\Facades\DB;

class HistoryRepositoryImplement extends Eloquent implements HistoryRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function createHistory($historyData)
    {
        return $this->history->create($historyData);
    }

    public function updateHistory($historyData, $historyId)
    {
        return $this->history->findOrFail($historyId)->update($historyData);
    }

    public function deleteHistory($historyId)
    {
        return $this->history->destroy($historyId);
    }

    public function getHistoryById($historyId)
    {
        return $this->history->findOrFail($historyId);
    }

    public function getHistories()
    {
        $data = $this->history->all();
        foreach($data as $key => $value){
            $photo = $value->history_image;
            $data[$key]->history_image =
                $value->history_image
                ? asset('storage/'. substr($photo, 7, strlen($photo)))
                : null;
        }
        return $data;
    }

    public function searchHistory($result)
    {
        $searchHistory = DB::table('histories')->where('history_year', 'like', '%' . $result . '%')->get();
        return $searchHistory;
    }

    public function countHistory(): int
    {
        $countHistory = DB::table('histories')->count();
        return $countHistory;
    }
}

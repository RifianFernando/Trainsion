<?php

namespace App\Repositories\Achievement;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class AchievementRepositoryImplement extends Eloquent implements AchievementRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $achievement;

    public function __construct(Achievement $achievement)
    {
        $this->achievement = $achievement;
    }

    public function getAchievements()
    {
        $data = $this->achievement->all();
        foreach($data as $key => $value){
            $photo = $value->achievement_poster;
            $data[$key]->achievement_poster =
                $value->achievement_poster
                ? asset('storage/'. substr($photo, 7, strlen($photo)))
                : null;
        }
        return $data;
    }

    public function getAchievementbyId($achievementId)
    {
        return $this->achievement->findOrFail($achievementId);
    }

    public function createAchievement($achievementData)
    {
        return $this->achievement->create($achievementData);
    }

    public function updateAchievement($achievementId, $achievementData)
    {
        return $this->achievement->findOrFail($achievementId)->update($achievementData);
    }

    public function deleteAchievement($achievementId)
    {
        return $this->achievement->destroy($achievementId);
    }

    public function countAchievement(): int
    {
        $countAchievement = DB::table('achievements')->count();
        return $countAchievement;
    }

}

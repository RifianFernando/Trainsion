<?php

namespace App\Services\Achievement;

use LaravelEasyRepository\BaseService;

interface AchievementService extends BaseService{

    public function getAchievements();
    public function getAchievementbyId($achievementId);
    public function createAchievement($request);
    public function updateAchievement($request, $achievementId);
    public function deleteAchievement($achievementId);
    public function countAchievement();

}

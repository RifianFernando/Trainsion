<?php

namespace App\Repositories\Achievement;

use LaravelEasyRepository\Repository;

interface AchievementRepository extends Repository{

    public function getAchievements();
    public function getAchievementbyId($achievementId);
    public function createAchievement($request);
    public function updateAchievement($request, $achievementId);
    public function deleteAchievement($achievementId);
    public function countAchievement();

}

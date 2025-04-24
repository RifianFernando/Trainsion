<?php

namespace App\Http\Controllers;

use App\Http\Requests\AchievementRequest;
use App\Services\Achievement\AchievementService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AchievementController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService){
        $this->achievementService = $achievementService;
    }

    public function getAchievements(){
        return $this->achievementService->getAchievements();
    }

    public function getAchievementbyId($achievementId){
        return $this->achievementService->getAchievementbyId($achievementId);
    }

    public function createAchievement(Request $request) : JsonResponse{
        return $this->achievementService->createAchievement($request)->toJson();
    }

    public function updateAchievement(Request $request, $achievementId) : JsonResponse{
        return $this->achievementService->updateAchievement($request, $achievementId)->toJson();
    }

    public function deleteAchievement($achievementId) : JsonResponse{
        return $this->achievementService->deleteAchievement($achievementId)->toJson();
    }

    public function countAchievement() : JsonResponse{
        return $this->achievementService->countAchievement()->toJson();
    }

}

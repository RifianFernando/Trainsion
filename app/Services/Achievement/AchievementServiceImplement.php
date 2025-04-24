<?php

namespace App\Services\Achievement;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Achievement\AchievementRepository;
use Illuminate\Support\Facades\Storage;

class AchievementServiceImplement extends ServiceApi implements AchievementService{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "Achievement";
    protected $create_message = "successfully created";
    protected $update_message = "successfully updated";
    protected $delete_message = "successfully deleted";

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $achievementRepository;

    public function __construct(AchievementRepository $achievementRepository)
    {
        $this->achievementRepository = $achievementRepository;
    }

    public function getAchievements()
    {
        try {
            return $this->achievementRepository->getAchievements();
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function getAchievementbyId($achievementId)
    {
        try {
            return $this->achievementRepository->getAchievementbyId($achievementId);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function createAchievement($request)
    {
        try {
            $file =
                $request->has('achievement_poster')
                ? $this->uploadFile(
                    $request->file('achievement_poster'),
                    $request->achievement_title
                )
                : null;
            $achievementData = [
                'achievement_poster' => $file,
                'achievement_title' => $request->achievement_title,
                'achievement_date' => $request->achievement_date,
                'achievement_description' => $request->achievement_description,
            ];
            $result = $this->achievementRepository->createAchievement($achievementData);
            return $this->setMessage(
                $this->title . " " . $this->create_message
            )
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function updateAchievement($request, $achievementId)
    {
        try {
            $achievement = $this->getAchievementbyId($achievementId);
            Storage::delete($achievement->achievement_poster);
            $file =
                $request->has('achievement_poster')
                ? $this->uploadFile($request->file('achievement_poster'), $request->achievement_title)
                : null;
            $achievementData = [
                'achievement_poster' => $file,
                'achievement_title' => $request->achievement_title,
                'achievement_date' => $request->achievement_date,
                'achievement_description' => $request->achievement_description,
            ];
            $result = $this->achievementRepository->updateAchievement($achievementId, $achievementData);
            return $this->setMessage($this->title . " " . $this->update_message)
                ->setStatus(true)
                ->setCode(200)
                ->setResult($result);
        } catch (\Exception $exception) {
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
        $path = $data->storeAs('/public/image/achievement', $fileWithExtension);
        $data->move(public_path() . '/storage/image/achievement', $fileWithExtension);
        return $path;
    }

    public function deleteAchievement($achievementId)
    {
        try {
            $achievement = $this->getAchievementbyId($achievementId);
            Storage::delete($achievement->achievement_poster);
            $this->achievementRepository->deleteAchievement($achievementId);
            return $this->setMessage($this->title . " " . $this->delete_message)
                ->setStatus(true)
                ->setCode(200);
        } catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function countAchievement()
    {
        try{
            $count = $this->achievementRepository->countAchievement();
            return $this->setStatus(true)->setCode(200)->setResult($count);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

}

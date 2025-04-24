<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Services\Photo\PhotoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function createPhoto(PhotoRequest $request) : JsonResponse{
        return $this->photoService->createPhoto($request)->toJson();
    }

    public function updatePhoto(Request $request, $photoId) : JsonResponse{
        return $this->photoService->updatePhoto($request, $photoId)->toJson();
    }

    public function deletePhoto($photoId) :JsonResponse {
        return $this->photoService->deletePhoto($photoId)->toJson();
    }

    public function getPhotoById($photoId) {
        return $this->photoService->getPhotoById($photoId);
    }

    public function getPhotos(){
        return $this->photoService->getPhotos();
    }

    public function typePhoto($type){
        return $this->photoService->typePhoto($type);
    }

    public function searchPhoto(Request $request) : JsonResponse {
        return $this->photoService->searchPhoto($request)->toJson();
    }

    public function countPhoto() : JsonResponse{
        return $this->photoService->countPhoto()->toJson();
    }
}

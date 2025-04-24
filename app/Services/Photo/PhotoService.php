<?php

namespace App\Services\Photo;

use LaravelEasyRepository\BaseService;

interface PhotoService extends BaseService{

    public function createPhoto($request);

    public function updatePhoto($request, $photoId);

    public function deletePhoto($photoId);

    public function getPhotoById($photoId);

    public function getPhotos();

    public function typePhoto($type);

    public function searchPhoto($request);

    public function countPhoto();
}

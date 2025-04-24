<?php

namespace App\Repositories\Photo;

use LaravelEasyRepository\Repository;

interface PhotoRepository extends Repository{

    public function createPhoto($photoData);

    public function updatePhoto($photoData, $photoId);

    public function deletePhoto($photoId);

    public function getPhotoById($photoId);

    public function getPhotos();

    public function typePhoto($type);

    public function searchPhoto($result);

    public function countPhoto();
}

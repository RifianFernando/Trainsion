<?php

namespace App\Repositories\Photo;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;

class PhotoRepositoryImplement extends Eloquent implements PhotoRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->photo variable name
    */
    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function createPhoto($photoData)
    {
        return $this->photo->create($photoData);
    }

    public function updatePhoto($photoData, $photoId)
    {
        return $this->photo->findOrFail($photoId)->update($photoData);
    }

    public function deletePhoto($photoId)
    {
        return $this->photo->destroy($photoId);
    }

    public function getPhotoById($photoId)
    {
        return $this->photo->findOrFail($photoId);
    }

    public function getPhotos()
    {
        $data = $this->photo->all();
        foreach($data as $key => $value){
            $image = $value->photo_image;
            $data[$key]->photo_image =
                $value->photo_image
                ? asset('storage/'. substr($image, 7, strlen($image)))
                : null;
        }
        return $data;;
    }

    public function typePhoto($type)
    {
        $photoType = DB::table('photos')->where('photo_type', '=', $type)->get();
        return $photoType;
    }

    public function searchPhoto($result)
    {
        $searchPhoto = DB::table('photos')->where('photo_title', 'like', '%' . $result . '%')->get();
        return $searchPhoto;
    }

    public function countPhoto(): int
    {
        $countPhoto = DB::table('photos')->count();
        return $countPhoto;
    }
}

<?php

namespace App\Services\Photo;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Photo\PhotoRepository;
use Illuminate\Support\Facades\Storage;

class PhotoServiceImplement extends ServiceApi implements PhotoService{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
    protected $title = "Photo";
    protected $create_message = "Successfuly created!";
    protected $update_message = "Successfuly updated!";
    protected $delete_message = "Successfuly deleted!";
    protected $search_message = "Found";

    /**
     * don't change $this->photoRepository variable name
     * because used in extends service class
     */
    protected $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    // Define your custom methods :)
    public function createPhoto($request)
    {
        try{
            // remove space and replace with underscore
            $photo_title = str_replace(' ', '_', $request->photo_title);
            $file_name = $photo_title.'-'.$request->photo_type;
            $file = $request->has('photo_image') ? $this->uploadFile($request->file('photo_image'), $file_name) : null;
            $photoData = [
                'photo_image' => $file,
                'photo_title' => $request->photo_title,
                'photo_type' => $request->photo_type,
                'photo_description' => $request->photo_description,
            ];
            $result = $this->photoRepository->createPhoto($photoData);
            return $this->setMessage($this->title." ".$this->create_message)->setStatus(true)->setCode(200)->setResult($result);
        }catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function updatePhoto($request, $photoId)
    {
        try{
            $photo = $this->getPhotoById($photoId);
            Storage::delete($photo->photo_image);
            $file_name = $request->photo_title.'-'.$request->photo_type;
            $file = $request->has('photo_image') ? $this->uploadFile($request->file('photo_image'), $file_name) : null;
            $photoData = [
                'photo_image' => $file,
                'photo_title' => $request->photo_title,
                'photo_type' => $request->photo_type,
                'photo_description' => $request->photo_description,
            ];
            $result = $this->photoRepository->updatePhoto($photoData, $photoId);
            return $this->setMessage($this->title." ".$this->update_message)->setStatus(true)->setCode(200)->setResult($result);

        }catch(\Exception $exception){
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
        $path = $data->storeAs('/public/image/photo', $fileWithExtension);
        $data->move(public_path() . '/storage/image/photo', $fileWithExtension);
        return $path;
    }

    public function deletePhoto($photoId)
    {
        try{
            $photo = $this->getPhotoById($photoId);
            Storage::delete($photo->photo_image);
            $result = $this->photoRepository->deletePhoto($photoId);
            return $this->setMessage($this->title." ".$this->delete_message)->setStatus(true)->setCode(200)->setResult($result);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getPhotoById($photoId)
    {
        try{
            return $this->photoRepository->getPhotoById($photoId);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getPhotos()
    {
        try{
            return $this->photoRepository->getPhotos();
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function typePhoto($type)
    {
        try{
            return $this->photoRepository->typePhoto($type);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function searchPhoto($request)
    {
        try{
            $result = $request->input('search');
            $searchResult = $this->photoRepository->searchPhoto($result);
            return $this->setMessage($this->search_message)->setStatus(true)->setCode(200)->setResult($searchResult);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function countPhoto()
    {
        try{
            $count = $this->photoRepository->countPhoto();
            return $this->setStatus(true)->setCode(200)->setResult($count);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }
}

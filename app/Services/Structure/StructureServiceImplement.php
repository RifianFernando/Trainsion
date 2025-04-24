<?php

namespace App\Services\Structure;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Structure\StructureRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class StructureServiceImplement extends ServiceApi implements StructureService{

    /**
     * set message api for CRUD
     * @param string $title
     * @param string $create_message
     * @param string $update_message
     * @param string $delete_message
     */
     protected $title = "Structure";
     protected $create_message = "Successfully Added";
     protected $update_message = "Successfully Updated";
     protected $delete_message = "Successfully Deleted";
     protected $search_message = "Found";

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $structureRepository;

    public function __construct(StructureRepository $structureRepository)
    {
      $this->structureRepository = $structureRepository;
    }

    public function createStructure($request)
    {
        try{
            $file_name = $request->profile_region.'-'.$request->profile_name;
            $file = $request->has('profile_photo') ? $this->uploadFile($request->file('profile_photo'), $file_name) : null;
            $structureData = [
                'profile_photo' => $file,
                'profile_name' => $request->profile_name,
                'profile_division' => $request->profile_division,
                'profile_sub_division' => $request->profile_sub_division,
                'profile_position' => $request->profile_position,
                'profile_region' => $request->profile_region,
                'profile_linkedin' => $request->profile_linkedin
            ];
            $result = $this->structureRepository->createStructure($structureData);
            return $this->setMessage($this->title." ".$this->create_message)->setStatus(true)->setCode(200)->setResult($result);
        }catch (\Exception $exception) {
            return $this->exceptionResponse($exception);
        }
    }

    public function updateStructure($request, $structureId)
    {
        try{
            $structure = $this->getStructureById($structureId);
            Storage::delete($structure->profile_photo);
            $file_name = $request->profile_region.'-'.$request->profile_name;
            $file = $request->has('profile_photo') ? $this->uploadFile($request->file('profile_photo'), $file_name) : null;
            $structureData = [
                'profile_photo' => $file,
                'profile_name' => $request->profile_name,
                'profile_division' => $request->profile_division,
                'profile_sub_division' => $request->profile_sub_division,
                'profile_position' => $request->profile_position,
                'profile_region' => $request->profile_region,
                'profile_linkedin' => $request->profile_linkedin
            ];
            $result = $this->structureRepository->updateStructure($structureId, $structureData);
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
        $path = $data->storeAs('/public/image/structure', $fileWithExtension);
        $data->move(public_path() . '/storage/image/structure', $fileWithExtension);
        return $path;
    }

    public function deleteStructure($structureId)
    {
        try{
            $structure = $this->getStructureById($structureId);
            Storage::delete($structure->profile_photo);
            $result = $this->structureRepository->deleteStructure($structureId);
            return $this->setMessage($this->title." ".$this->delete_message)->setStatus(true)->setCode(200)->setResult($result);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getStructureById($structureId)
    {
        try{
            return $this->structureRepository->getStructureById($structureId);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getStructures()
    {
        try{
            return $this->structureRepository->getStructures();
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getStructureByRegion($region)
    {
        try{
            return $this->structureRepository->getStructureByRegion($region);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function searchStructure($request)
    {
        try{
            $result = $request->input('search');
            $searchResult = $this->structureRepository->searchStructure($result);
            return $this->setMessage($this->search_message)->setStatus(true)->setCode(200)->setResult($searchResult);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function countStructure()
    {
        try{
            $count = $this->structureRepository->countStructure();
            return $this->setStatus(true)->setCode(200)->setResult($count);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

    public function getStructuredRegionByDivision($region){
        try{
            $result = $this->structureRepository
                            ->getStructuredRegionByDivision($region);
            // dd($result);
            if (count($result) == 0)
                return $this->setStatus(false)
                            ->setCode(404)
                            ->setMessage("Not Found")
                            ->setResult($result);
            return $this->setStatus(true)
                        ->setCode(200)
                        ->setResult($result)
                        ->setMessage($this->search_message);
        }catch(\Exception $exception){
            return $this->exceptionResponse($exception);
        }
    }

}

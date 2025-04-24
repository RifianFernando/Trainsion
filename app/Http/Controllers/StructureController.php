<?php

namespace App\Http\Controllers;

use App\Http\Requests\StructureRequest;
use App\Services\Structure\StructureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructureController extends Controller
{
    protected $structureService;

    public function __construct(StructureService $structureService)
    {
        $this->structureService = $structureService;
    }

    public function createStructure(StructureRequest $request) : JsonResponse{
        return $this->structureService->createStructure($request)->toJson();
    }

    public function updateStructure(Request $request, $structureId) : JsonResponse{
        return $this->structureService->updateStructure($request, $structureId)->toJson();
    }

    public function deleteStructure($structureId) :JsonResponse {
        return $this->structureService->deleteStructure($structureId)->toJson();
    }

    public function getStructureById($structureId) {
        return $this->structureService->getStructureById($structureId);
    }

    public function getStructures(){
        return $this->structureService->getStructures();
    }

    public function getStructureByRegion($region){
        return $this->structureService->getStructureByRegion($region);
    }

    public function searchStructure(Request $request) : JsonResponse {
        return $this->structureService->searchStructure($request)->toJson();
    }

    public function countStructure() : JsonResponse{
        return $this->structureService->countStructure()->toJson();
    }

    public function getStructuredRegionByDivision($region) : JsonResponse{
        return $this->structureService->getStructuredRegionByDivision($region)->toJson();
    }
}

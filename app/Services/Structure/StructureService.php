<?php

namespace App\Services\Structure;

use LaravelEasyRepository\BaseService;

interface StructureService extends BaseService{

    public function createStructure($request);

    public function updateStructure($request, $structureId);

    public function deleteStructure($structureId);

    public function getStructureById($structureId);

    public function getStructures();

    public function getStructureByRegion($region);

    public function searchStructure($request);

    public function countStructure();

    public function getStructuredRegionByDivision($region);
}

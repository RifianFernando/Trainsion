<?php

namespace App\Repositories\Structure;

use LaravelEasyRepository\Repository;

interface StructureRepository extends Repository{

    public function createStructure($structureData);

    public function updateStructure($structureId, $structureData);

    public function deleteStructure($structureId);

    public function getStructureById($structureId);

    public function getStructures();

    public function getStructureByRegion($region);

    public function searchStructure($result);

    public function countStructure();

    public function getStructuredRegionByDivision($region);
}

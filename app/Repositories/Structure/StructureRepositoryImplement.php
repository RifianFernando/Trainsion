<?php

namespace App\Repositories\Structure;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Structure;
use Illuminate\Support\Facades\DB;

class StructureRepositoryImplement extends Eloquent implements StructureRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $structure;

    public function __construct(Structure $structure)
    {
        $this->structure = $structure;
    }

    public function createStructure($structureData)
    {
        return $this->structure->create($structureData);
    }

    public function updateStructure($structureId, $structureData)
    {
        return $this->structure->findOrFail($structureId)->update($structureData);
    }

    public function deleteStructure($structureId)
    {
        return $this->structure->destroy($structureId);
    }

    public function getStructureById($structureId)
    {
        return $this->structure->findOrFail($structureId);
    }

    public function getStructures()
    {
        $data = $this->structure->all();
        foreach($data as $key => $value){
            $photo = $value->profile_photo;
            $data[$key]->profile_photo =
                $value->profile_photo
                ? asset('storage/'. substr($photo, 7, strlen($photo)))
                : null;
        }
        return $data;
    }

    public function getStructureByRegion($region)
    {
        $structureRegion = DB::table('structures')->where('profile_region', '=', $region)->get();
        // change photo return
        foreach($structureRegion as $key => $value){
            $photo = $value->profile_photo;
            $structureRegion[$key]->profile_photo =
                $value->profile_photo
                ? asset('storage/'. substr($photo, 7, strlen($photo)))
                : null;
        }
        return $structureRegion;
    }

    public function searchStructure($result)
    {
        $searchStructure = DB::table('structures')->where('profile_name', 'like', '%' . $result . '%')->get();
        // change photo return
        foreach($searchStructure as $key => $value){
            $photo = $value->profile_photo;
            $searchStructure[$key]->profile_photo =
                $value->profile_photo
                ? asset('storage/'. substr($photo, 7, strlen($photo)))
                : null;
        }
        return $searchStructure;
    }

    public function countStructure(): int
    {
        $countStructure = DB::table('structures')->count();
        return $countStructure;
    }

    public function getStructuredRegionByDivision($region)
    {
        $data = $this->getStructureByRegion($region);

        // If no data, return an empty array
        if (count($data) == 0) {
            return [];
        }

        // Get all chief data
        $chiefData = collect($data)
            ->where('profile_sub_division', 'Chief')
            ->map(function ($chiefData) {
                return [
                    'id' => $chiefData->id,
                    'profile_photo' => $chiefData->profile_photo,
                    'profile_name' => $chiefData->profile_name,
                    'profile_division' => $chiefData->profile_division,
                    'profile_sub_division' => $chiefData->profile_sub_division,
                    'profile_position' => $chiefData->profile_position,
                    'profile_region' => $chiefData->profile_region,
                    'profile_linkedin' => $chiefData->profile_linkedin,
                    'created_at' => $chiefData->created_at,
                    'updated_at' => $chiefData->updated_at,
                    // ... other fields
                ];
            })
            ->values();

        // Format chief data
        $formatChiefData = [
            'division' => 'Chief',
            'data' => [
                'sub_division' => 'Chief',
                'data' => $chiefData,
            ]
        ];

        // Get all divisions without chief and group by profile_division
        $groupedData = collect($data)
            ->where('profile_sub_division', '!=', 'Chief')
            ->groupBy('profile_division');

        // Format the divisions
        $formattedData = $groupedData->map(function ($divisionData, $divisionName) {
            return [
                'division' => $divisionName . ' Division',
                // format the data again group by profile_sub_division
                'data' => collect($divisionData)
                    ->groupBy('profile_sub_division')
                    ->map(function ($subDivisionData, $subDivisionName) {
                        return [
                            'sub_division' => $subDivisionName,
                            'data' => $subDivisionData,
                        ];
                    })
                    ->values(),
            ];
        })->values();

        // Add chief data to the first index
        $formattedData->prepend($formatChiefData);

        return $formattedData;

    }
}

<?php

namespace Database\Seeders;

use App\Models\TrainStation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainStation::create([
            'name'=> 'Gambir',
        ]);
        TrainStation::create([
            'name'=> 'Pasar Senen',
        ]);
        TrainStation::create([
            'name'=> 'Jakarta Kota',
        ]);
        TrainStation::create([
            'name'=> 'Surabaya',
        ]);
        TrainStation::create([
            'name'=> 'Nagreg',
        ]);
        TrainStation::create([
            'name'=> 'Yogyakarta',
        ]);
        TrainStation::create([
            'name'=> 'Cirebon',
        ]);
        TrainStation::create([
            'name'=> 'Kutoarjo',
        ]);
    }
}

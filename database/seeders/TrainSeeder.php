<?php

namespace Database\Seeders;

use App\Models\trains;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        trains::create([
            'name' => 'Kuto Jaya Utara',
            'train_image' => 'testingimage',
            'description' => 'Kutajaya utara Descc',
            'departure_time' => '2025-10-06 10:00:00',
            'origin_train_station_id' => '1',
            'destination_train_station_id' => '3',
            'economy_price' => '80000',
            'executive_price' => '200000',
            'seats_available' => 300
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=> 'admin@train.com',
            'password' =>bcrypt('ThePowerOfAdmin2025'),
            'isAdmin'=> true,
        ]);
        DB::table('users')->insert([
            'name' => 'Rifian Fernando',
            'email' => 'rifianfernando19@gmail.com',
            'password' => bcrypt('SmoothyShake'),
            'isAdmin' => false,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // KMG
        // Chief
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_081846.jpg',
            "profile_name" => "Gracella Noveliora",
            "profile_division" => "Executive",
            "profile_sub_division" => "Chief",
            "profile_position" => "CEO",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_081950.jpg',
            "profile_name" => "Audrey",
            "profile_division" => "Finance",
            "profile_sub_division" => "Chief",
            "profile_position" => "CFO",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_081954.jpg',
            "profile_name" => "Andini Malavika",
            "profile_division" => "Marketing",
            "profile_sub_division" => "Chief",
            "profile_position" => "CMO",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_090049.jpg',
            "profile_name" => "Steven Nataniel",
            "profile_division" => "Product",
            "profile_sub_division" => "Chief",
            "profile_position" => "CPO",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_090053.jpg',
            "profile_name" => "Mutiara Rahmah",
            "profile_division" => "Internal",
            "profile_sub_division" => "Chief",
            "profile_position" => "CIO",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // PR
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_092235.jpg',
            "profile_name" => "Tania",
            "profile_division" => "Marketing",
            "profile_sub_division" => "PR",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_100331.jpg',
            "profile_name" => "Julian Abrar",
            "profile_division" => "Marketing",
            "profile_sub_division" => "PR",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // EEO
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_100408.jpg',
            "profile_name" => "Celina Josephine",
            "profile_division" => "Marketing",
            "profile_sub_division" => "EEO",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113024.jpg',
            "profile_name" => "Febrico Jonathan",
            "profile_division" => "Marketing",
            "profile_sub_division" => "EEO",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // FAVE
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113028.jpg',
            "profile_name" => "Christopher Tessy",
            "profile_division" => "Product",
            "profile_sub_division" => "FAVE",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113032.jpg',
            "profile_name" => "Lutfhi Nadhil",
            "profile_division" => "Product",
            "profile_sub_division" => "FAVE",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // FILE
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113028.jpg',
            "profile_name" => "Fabian Djaja",
            "profile_division" => "Product",
            "profile_sub_division" => "FILE",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113032.jpg',
            "profile_name" => "Joshua valentine",
            "profile_division" => "Product",
            "profile_sub_division" => "FILE",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // LNT
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113028.jpg',
            "profile_name" => "Valencius rianto",
            "profile_division" => "Product",
            "profile_sub_division" => "LNT",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113032.jpg',
            "profile_name" => "Arrick Russel",
            "profile_division" => "Product",
            "profile_sub_division" => "LNT",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // HRD
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113028.jpg',
            "profile_name" => "Alfred",
            "profile_division" => "Internal",
            "profile_sub_division" => "HRD",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113032.jpg',
            "profile_name" => "Karren Jessica",
            "profile_division" => "Internal",
            "profile_sub_division" => "HRD",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        // RnD
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113028.jpg',
            "profile_name" => "Jonathan Christian",
            "profile_division" => "Internal",
            "profile_sub_division" => "RND",
            "profile_position" => "Manager",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_113032.jpg',
            "profile_name" => "Joshua Defario",
            "profile_division" => "Internal",
            "profile_sub_division" => "RND",
            "profile_position" => "Staff",
            "profile_region" => "KMG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);

        // ALS
        // Chief
        \App\Models\Structure::create([
            "profile_photo" => 'public/image/structure/20230429_081846.jpg',
            "profile_name" => "Ethan Mathias",
            "profile_division" => "Executive",
            "profile_sub_division" => "Chief",
            "profile_position" => "CEO",
            "profile_region" => "BDG",
            "profile_linkedin" => "https://www.linkedin.com/in/rifian-fernando"
        ]);
    }
}

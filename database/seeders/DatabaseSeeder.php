<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CourseSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(NotesSeeder::class);
        //$this->call(EvidenceSeeder::class);
        $this->call(UserSeeder::class);
        //$this->call(CourseUserSeeder::class);
    }
}

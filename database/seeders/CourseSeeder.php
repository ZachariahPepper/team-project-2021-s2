<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/course.json');
        DB::table('courses')->delete();
        $data = json_decode($json_file);
        foreach ($data as $obj) {
            Course::create(array(
                'course' => $obj->course
            ));
        }
    }
}

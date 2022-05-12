<?php

namespace Database\Seeders;

use App\Models\Course_User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/courses_users.json');
        DB::table('courses_users')->delete();
        $data = json_decode($json_file);
        foreach ($data as $obj) {
            CoursesUsers::create(array(
                'course_id' => $obj->course_id,
                'user_id' => $obj->user_id,
            ));
        }
    }
}
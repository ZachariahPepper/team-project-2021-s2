<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/student.json');
        DB::table('students')->delete();
        $data = json_decode($json_file);
        foreach ($data as $obj) {
            Student::create(array(
                'course_id' => $obj->course_id,
                'name' => $obj->name,
                'email' => $obj->email,
                'github' => $obj->github
            ));
        }
    }
}

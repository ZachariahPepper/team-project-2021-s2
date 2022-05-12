<?php

namespace Database\Seeders;

use App\Models\Evidence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/evidence.json');
        DB::table('evidence')->delete();
        $data = json_decode($json_file);
        foreach ($data as $obj) {
            Evidence::create(array(
            'student_id' => $obj->student_id,
            'url' => $obj->url,
            'description' => $obj->description,
            ));
        } 
    }
}

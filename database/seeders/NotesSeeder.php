<?php

namespace Database\Seeders;

use App\Models\Notes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/notes.json');
        DB::table('notes')->delete();
        $data = json_decode($json_file);
        foreach ($data as $obj) {
            Notes::create(array(
            'student_id' => $obj->student_id,
            'note' => $obj->note,
            ));
        } 
    }
}

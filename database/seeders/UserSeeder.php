<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'is_admin' => 1
        ]);
    }

        // $json_file = File::get('database/data/user.json');
        // DB::table('users')->delete();
        // $data = json_decode($json_file);
        // foreach ($data as $obj) {

}


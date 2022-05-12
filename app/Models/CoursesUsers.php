<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesUsers extends Model
{
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    public $table = 'courses_users';
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $fillable = [
        'course_id','user_id'
    ];
}

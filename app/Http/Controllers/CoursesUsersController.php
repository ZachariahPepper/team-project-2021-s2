<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesUsers;
use App\Models\Course;
use App\Models\User;

class CoursesUsersController extends Controller
{
    // To get all courses of a user
    public function getCourses($user_id)
    {
        return User::find($user_id)->courses;
    }

    // To get all users by course
    public function getUsers($course_id)
    {
        return Course::find($course_id)->users;
    }
}

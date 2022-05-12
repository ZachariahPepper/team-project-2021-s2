<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\CoursesUsers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function studio1()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');

        $students = DB::table('students')
                ->where('course_id', '=', 1)
                ->get();
        $studio_num = 1;
        return view('dashboard.studio1', compact('students', 'courses_users', 'studio_num'));
    }

    public function studio2()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');

        $students = DB::table('students')
                ->where('course_id', '=', 2)
                ->get();
        $studio_num = 2;
        return view('dashboard.studio1', compact('students', 'courses_users', 'studio_num'));
    }

    public function studio3()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');

        $students = DB::table('students')
                ->where('course_id', '=', 3)
                ->get();
        $studio_num = 3;
        return view('dashboard.studio1', compact('students', 'courses_users', 'studio_num'));
    }

    public function studio4()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');

        $students = DB::table('students')
                ->where('course_id', '=', 4)
                ->get();
        $studio_num = 4;
        return view('dashboard.studio1', compact('students', 'courses_users', 'studio_num'));
    }

    public function studio5()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');

        $students = DB::table('students')
                ->where('course_id', '=', 5)
                ->get();
        $studio_num = 5;
        return view('dashboard.studio1', compact('students', 'courses_users', 'studio_num'));
    }

    public function studio6()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');

        $students = DB::table('students')
                ->where('course_id', '=', 6)
                ->get();
                $studio_num = 6;
        return view('dashboard.studio1', compact('students', 'courses_users', 'studio_num'));
    }
}

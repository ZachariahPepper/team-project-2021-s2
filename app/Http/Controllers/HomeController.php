<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesUsers;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses_users = DB::table('courses_users')
                ->where('user_id', '=', Auth::user()->id)
                ->get('course_id');
        return view('home', compact('courses_users'));
    }
}

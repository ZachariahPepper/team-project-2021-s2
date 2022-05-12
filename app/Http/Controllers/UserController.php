<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\CoursesUsers;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
       
        $this->middleware('auth');
        $this->middleware('adminUser');
    }
    
      /*
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('users.create', ['courses' => $courses]);
    }

    public function role($role) {     
        $role = (array)$role;    
      
        return in_array($this->role, $role); 
     }    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'course' => ['required_without_all'],
        ]);

        $user = new User([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($validated['password']),
        ]);
        $user->save();

        $coursesArr = $request->course;
        $course = new Course([
            'id' => $request->get('id'),
            'course' =>$request->get('course'),
        ]);

        foreach($coursesArr as $course) {
            DB::table('courses_users')->insert([
                'user_id' => $user->id,
                'course_id' => $course,
            ]);
        }
        return redirect('/users')->with('success', 'User created!');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        return redirect('/users')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User deleted!');
    }
}

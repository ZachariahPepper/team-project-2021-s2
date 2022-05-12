<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use App\Models\Student;
use App\Models\Evidence;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:students'],
            'github' => ['required', 'string', 'max:255', 'unique:students'],
        ]);

        $student = new Student([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'github' => $request->get('github'),
            'course_id' => $request->get('course_id')
        ]);
            $student->save();
            return redirect('/students')->with('success', 'Student created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::find($id);
        return view('students/show', compact('students'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', compact('student')); 
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

        $student = Student::find($id);
        $student->name =  $request->get('name');
        $student->email = $request->get('email');
        $student->github = $request->get('github');
        $student->course_id = $request->get('course_id');
        $student->save();

        return redirect('/students')->with('success', 'Student updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted!');
    }
}

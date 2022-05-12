<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\Student;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Notes::all();
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all(['id', 'name']);
        return view('notes.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'note' => ['required', 'string', 'max:255']
        ]);

        $notes = new Notes([
            'student_id'=> $request->get('student_id'),
            'note'=> $request->get('note')
        ]);
        $notes->save();
        return redirect('/notes/create')->with('success', 'Note saved!');
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
        return view('notes.show', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Notes::find($id);
        return view('notes.edit', compact('note')); 
    }

    public function update(Request $request, $id)
    {
        $note = Notes::find($id);
        $note->note =  $request->get('note');
        $note->save();

        return redirect('/students')->with('success', 'Note updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notes = Notes::find($id);
        $notes->where('id', $id)->delete();
        return back()->with('success', 'Note deleted!');
    }
}

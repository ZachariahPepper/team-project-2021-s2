<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use App\Models\Evidence;
use App\Models\Student;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;
use Str;

class EvidenceController extends Controller
{
    protected $file;
    
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
        return view('evidence.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all(['id','name']);
        $evidence = Evidence::all(['file']);
        return view('evidence.create', compact('students', 'evidence'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $path = $request->file('file')->store('file', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        $url = Storage::disk('s3')->url($path);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255']
        ]);

        $evidence = new Evidence([
            'student_id'=> $request->get('student_id'),
            'url' => $url,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'file' => $request->file->storeAs('s3', $request->file->getClientOriginalName())
        ]);

        $evidence->save();
        return redirect('/evidence/create')->with('success', 'Evidence submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $url = DB::table('evidence')
                ->where('id', '=', $id)
                ->get('url');
        $url = Str::after($url, ':');
        $url = Str::after($url, '"');
        $url = Str::before($url, '"');
        $url = Str::remove('\\', $url);
        return redirect()->away($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evidence = Evidence::find($id);
        return view('evidence/edit', compact('evidence'));
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
        $evidence = Evidence::find($id);
        $evidence->title = $request->get('title');
        $evidence->description = $request->get('description');
        $evidence->file = $request->get('file');
        $evidence->save();

        return redirect('/students')->with('success', 'Evidence updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evidence = Evidence::find($id);
        $url = DB::table('evidence')
                ->where('id', '=', $id)
                ->get('url');

        $url = Str::after($url, ':');
        $url = Str::after($url, '"');
        $url = Str::before($url, '"');
        $url = Str::remove('\\', $url);
        $url = Str::after($url, 'com');
        $url = Str::after($url, '/');

        Storage::disk('s3')->delete($url);
        $evidence->delete();
    
    return back()->with('success', 'Submission deleted!');
    }
}

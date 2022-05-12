@extends('layouts.navbar')

@section('title', 'Students')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a student</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('students.update', $student->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="name">Name:</label>
                
                <input dusk='edit-student-name' type="text" class="form-control" name="name" value="{{$student->name}}"/>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $student->email }} />
            </div>

            <div class="form-group">
                <label for="github">Github:</label>
                <input type="text" class="form-control" name="github" value={{ $student->github }} />
            </div>


            <div class="form-group">
                <label for="course_id">Course:</label>
                <select dusk="edit-student-courses-id" name="course_id" class="form-control" id="course_id">
                    <option value=1>Studio 1</option>
                    <option value=2>Studio 2</option>
                    <option value=3>Studio 3</option>
                    <option value=4>Studio 4</option>
                    <option value=5>Studio 5</option>
                    <option value=6>Studio 6</option>
                </select>
            </div>
            
            <button dusk='edit-student-submit' type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
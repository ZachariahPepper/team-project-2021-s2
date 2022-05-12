@extends('layouts.navbar')

@section('title', 'Students')

@section('content')

<div>
@if(session()->get('success'))
    <div dusk="student-success" class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>

<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Students</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>Email</td>
          <td>Github</td>
          <td colspan = 4>Course</td>
        </tr>
    </thead>
    <div>
    <a dusk="create-student-button"style="margin: 19px;" href="{{ route('students.create')}}" class="btn btn-primary">New student</a>
    </div>
    <tbody>
        @foreach($students as $index => $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->github}}</td>
            <td>Studio {{$student->course_id}}</td>

            <td>
                <a dusk="edit-student-{{$index}}" href="{{ route('students.edit',$student->id)}}" class="btn btn-primary">Edit Student</a>
            </td>
            <td>
                <form action="{{ route('students.destroy', $student->id)}}" method="post">
                
                <a dusk = 'submissions' href="{{ route('students.show',$student->id)}}" class="btn btn-primary">View Submissions</a>

            </td>
            <td>
                <form action="{{ route('students.destroy',$student->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button dusk ="delete-student-{{$index}}" class="btn btn-danger" type="submit">Delete Student</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
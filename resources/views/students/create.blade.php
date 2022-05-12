@extends('layouts.navbar')

@section('title', 'Students')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a student</h1>
            <div>
                <form method="post" action="{{ route('students.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input dusk="student-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"/>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        
                        <input dusk="student-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"/>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="github">Github:</label>
                        <input dusk="student-git" type="text" class="form-control @error('github') is-invalid @enderror" name="github" value="{{ old('github') }}"/>

                        @error('github')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="course_id">Course:</label>

                        <select dusk="student-courses-id" name="course_id" class="form-control" id="course_id">
                            <option value=1>Studio 1</option>
                            <option value=2>Studio 2</option>
                            <option value=3>Studio 3</option>
                            <option value=4>Studio 4</option>
                            <option value=5>Studio 5</option>
                            <option value=6>Studio 6</option>

                        </select>
                    </div>

                    <button dusk="submit-student" type="submit" class="btn btn-primary">Add Student</button>
                </form>
            </div>
        </div>
    </div>
@endsection

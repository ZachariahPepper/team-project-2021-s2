@extends('layouts.navbar')

@section('title', "Evidence")

@section('content')

<div class="row">
    <div dusk="evidence-dashboard" class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Submit Evidence</h1>
        <div class="container mt-5">
            <form action="{{route('evidence.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <div class="form-group">
                    <select class="form-control" name="student_id">
                        @foreach($students as $student)
                            <option dusk="evidence-drop-down" value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input dusk="title" type="text" class="form-control" name="title"/>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input dusk="description" type="text" class="form-control" name="description"/>
                </div>

                <div class="form-group">
                    <input type="file" name="file" class="form-control-file">
                </div>

                <button dusk="add-evidence-btn" type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    Upload Files
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 
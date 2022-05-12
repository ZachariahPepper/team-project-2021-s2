@extends('layouts.navbar')

@section('title', 'Notes')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">Notes</h1>    
      <table class="table table-striped">
        <thead>
            <tr>
              <td>Notes</td>
              <td>StudentID</td>
            </tr>
        </thead>
        <div>
        <a style="margin: 19px;" href="{{ route('notes.create', $students->id)}}" class="btn btn-primary">New Note</a>
        </div>
        <tbody>
            @foreach($students->notes as $notes)
            <tr>
                <td>{{$notes->documentation}}</td>
                <td>{{$notes->student_id}}</td>
                <td>
                    <a href="{{ route('notes.edit', $students->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('notes.destroy', $notes->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
      </table>
    <div>
</div>
@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
@endsection
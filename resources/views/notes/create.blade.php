@extends('layouts.navbar')

@section('title', 'Notes')

@section('content')
<div class="row">
 <div dusk="notes-dashboard" class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Note</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    
      <form method="post" action="{{ route('notes.store')}}">
          @csrf 
              <div class="form-group">
                <select class="form-control" name="student_id">
                  @foreach($students as $student)
                    <option dusk="note-drop-down" value="{{$student->id}}">{{$student->name}}</option>
                  @endforeach
                </select>
              </div>     

              <div class="form-group">
                <label for="note">Notes:</label>
                <input dusk="note" type="text" class="form-control" name="note"/>
              </div>     
          <button dusk="add-note-btn" type="submit" class="btn btn-primary">Add Note</button>
      </form>
      @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
      @endif
  </div>
</div>
</div>
@endsection
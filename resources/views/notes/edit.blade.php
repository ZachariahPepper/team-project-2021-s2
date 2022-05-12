@extends('layouts.navbar')

@section('title', 'Students')

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a note</h1>

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
        <form method="post" action="{{ route('notes.update', $note->id)}}">
            @method('PATCH') 
            @csrf

            <div class="form-group">
                <label for="note">Notes:</label>
                <input dusk = "notes-input"type="text" class="form-control" name="note" value="{{ $note->note }}" />
            </div>
                <button dusk = 'edit-note-submit' type="submit" class="btn btn-primary">Edit Note</button>
        </form>
    </div>
</div>
@endsection
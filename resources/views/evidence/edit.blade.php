@extends('layouts.navbar')

@section('title', "Edit Evidence")

@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Edit a Submission</h1>
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
            <form method="post" action="{{ route('evidence.update', $evidence->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="url">Url:</label>
                    <input dusk = "evidence-url"type="text" class="form-control" name="url" value={{ $evidence->url }}/>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input dusk = "description-evidence" type="text" class="form-control" name="description" value={{ $evidence->description }}/>
                </div>
                <button dusk = "edit-evidence-submit"type="submit" class="btn btn-primary">Edit Evidence</button>
            </form>
        </div>
    </div>
</div>
<div>
    @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}  
        </div>
    @endif
</div>
@endsection 
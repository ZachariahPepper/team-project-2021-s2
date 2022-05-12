@extends('layouts.navbar')

@section('title', 'Evidence')

@section('content')

<div>
    @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}  
        </div>
    @endif
</div>

<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">{{$students->name}}</h1>
        <p class="col-sm-12">{{$students->student_id}}</p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td colspan = 5><h5>Evidence Submissions for {{$students->name}}</h5></td>
                </tr>
            </thead>
            <div>
            <a dusk = 'back-students'style="margin: 19px" href="{{ route('students.index')}}" class="btn btn-primary">Back to Students</a>
            </div>
            <tbody>
                @forelse ($students->evidence as $evidence)
                <tr>
                    <td>
                        <a href="{{ route('evidence.show', $evidence->id)}}">{{$evidence->title}}
                    </td>
                    <td>
                        <p>{{$evidence->description}}
                    </td>
                    <td>
                        <a href="{{route ('evidence.edit', $evidence->id)}}" class="btn btn-primary">Edit Submission</a>
                    </td>
                    <td>
                        <form action="{{ route('evidence.destroy',$evidence->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button dusk= "evidence-delete" class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <td>
                        No Evidence Found In Records
                    </td>
                @endforelse
                <tr> 
                    <td colspan=5><h5>Notes Submissions for {{$students->name}}</h5></td>
                </tr>

                @forelse($students->notes as $notes)
            <tr>
                <td>
                    <p>{{$notes->note}}</p>
                </td>
                <td>
                    <a dusk = "edit-notes" href="{{route ('notes.edit', $notes->id)}}" class="btn btn-primary">Edit Submission</a>

                </td>
                <td>
                    <form action="{{ route('notes.destroy', $notes->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <button dusk='delete-notes' class="btn btn-flex btn-danger" type="submit">Delete</button>

                    </form>
                </td>
            </tr>
            @empty
                <td colspan=5>
                    No Notes Found In Records
                </td>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
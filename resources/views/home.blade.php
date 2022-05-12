@extends('layouts.navbar')

@section('content')

<div dusk = "home-dashboard" class="container">
    <div class="row justify-content-center">
        @if ($courses_users->isEmpty())
            <div class="card" >
                <div class="card-body" style="padding: 5px;">
                    <h5 class="card-title">You do not appear to have any courses</h5>
                </div>
            </div>
        @else
            @foreach ($courses_users as $index => $courses_users)
                <div class="card" style="width: 10rem;  height: 6rem; margin-left: 10px; margin-right: 10px;">
                    <div class="card-body" style="padding: 5px;">
                        <h5 class="card-title">Studio {{$courses_users->course_id}}</h5>
                        <a href="/studio{{$courses_users->course_id}}" class="btn btn-primary">View</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
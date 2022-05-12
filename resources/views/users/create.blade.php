@extends('layouts.navbar')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a user</h1>
            <div>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input dusk = "register-name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input dusk = "register-email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input dusk="register-password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input dusk="register-password-confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                    </div>

                    @error('course') 
                        <strong style="color:red; font-size:80%">{{ $message }}</strong>
                    @enderror

                    @foreach($courses as $create => $course)
                        <div class="form-group">
                        <label for="{{ __($course->course_id) }}" ><input dusk="select-course-{{$create}}" type="checkbox" name="course[{{ $course->course }}]" id="{{ $course->course }}" value="{{ $course->id }}" > <span>{{ $course->course }}</span></label>
                        </div>
                    @endforeach

                    <button dusk="register-submit" type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

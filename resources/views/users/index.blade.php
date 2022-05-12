@extends('layouts.navbar')

@section('title', 'Users')

@section('content')

<div>
@if(session()->get('success'))
    <div dusk="user-success" class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>

<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Users</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td colspan=4>Email</td>
        </tr>
    </thead>
    <div>
    <a dusk="create-user-button"style="margin: 19px;" href="{{ route('users.create')}}" class="btn btn-primary">New user</a>
    </div>
    <tbody>
        @foreach($users as $index => $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>

            <td>
                <a dusk="edit-user-{{$index}}" href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit User</a>
            </td>
            <td>
                <form action="{{ route('users.destroy', $user->id)}}" method="post">
            </td>
            <td>
                <form action="{{ route('users.destroy',$user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button dusk ="delete-user-{{$index}}" class="btn btn-danger" type="submit">Delete User</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
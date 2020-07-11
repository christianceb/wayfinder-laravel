@extends('layouts.app')

@section('title')
  Users: View
@endsection

@section('content')
  <div class="container">
    <h1>Users: View</h1>

    <a class="btn btn-secondary" href="{{ route('users.index') }}" role="button">Back to Users</a>
    
    <form>
      <div class="form-group">
        <label>Name</label>
        <input type="name" class="form-control form-control-plaintext" value="{{$user->name}}" readonly/>
      </div>
      
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control form-control-plaintext" value="{{$user->email}}" readonly/>
      </div>
    </form>

    <a class="btn btn-primary" href="{{ route('users.edit', $user) }}" role="button">Edit User</a>
  </div>
@endsection
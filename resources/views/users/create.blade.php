@extends('layouts.app')

@section('title')
  Users: Create
@endsection

@section('content')
  <div class="container">
    <h1>Users: Create</h1>

    <a class="btn btn-primary" href="{{ route('users.index') }}" role="button">Back to Users</a>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="post" action="{{ route('users.store') }}">
      @csrf

      <div class="form-group">
        <label>Name</label>
        <input type="name" class="form-control" name="name" value="{{ old('name') }}">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
      </div>

      <button type="submit" class="btn btn-primary">Create User</button>
    </form>
  </div>
@endsection
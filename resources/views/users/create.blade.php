@extends('layouts.app')

@section('title')
Users: Create
@endsection

@section('content')
<div class="container">
  <h1>Users: Add</h1>
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
      <input type="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter User name here..." required>

      @error('name')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="example@example.com" required>

      @error('email')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" name="password" placeholder="Set password here.." required>

      @error('password')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{ route('users.index') }}" role="button">Cancel</a>
  </form>
</div>
@endsection
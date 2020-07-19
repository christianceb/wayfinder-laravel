@extends('layouts.app')

@section('title')
  Users: Edit
@endsection

@section('content')
    <div class="container">
        <h1>Uploads: Edit</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('users.update', $user) }}">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="name" class="form-control" name="name" value="{{$user->name}}" required/>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="{{$user->email}}" readonly/>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required/>
            </div>

            <button type="submit" class="btn btn-primary">Save changes</button>
            <a class="btn btn-danger" href="{{ route('users.show', $user) }}" role="button">Cancel</a>
        </form>
    </div>
@endsection

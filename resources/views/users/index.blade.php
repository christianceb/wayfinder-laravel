@extends('layouts.app')

@section('title')
  Users
@endsection

@section('content')
<div class="container">
    <h1>Users</h1>
    <div class="mt-2 mb-3">
      <a href="{{route('users.create')}}" class="btn btn-success">
          Create
      </a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>
            <a href="{{ route('users.show', $user)}}" class="btn btn-primary">Show</a>
            <a href="{{ route('users.edit', $user)}}" class="btn btn-secondary">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endsection

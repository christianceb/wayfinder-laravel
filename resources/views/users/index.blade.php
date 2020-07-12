@extends('layouts.app')

@section('title')
  Users
@endsection

@section('content')
<div class="row">
  <div class="col">
    <div>
      <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
    </div>
    <table class="table responsive">
      <thead>
        <tr>
          <td>Id</td>
          <td>Name</td>
          <td>Email</td>
          <td></td>
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
            <a href="{{ route('users.edit', $user)}}" class="btn btn-warning">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection
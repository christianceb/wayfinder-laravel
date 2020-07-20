@extends('layouts.app')

@section('title')
Users: View
@endsection

@section('content')
<div class="container">
  <h1>Users: Show</h1>
  <table class="table">
    <tbody>
      <tr>
        <th scope="col" class="text-primary">Name</th>
        <td>{{$user->name}}</td>
      </tr>
      <tr>
        <th scope="col" class="text-primary">Email</th>
        <td>{{$user->email}}</td>
      </tr>
    </tbody>
  </table>
  <a class="btn btn-primary" href="{{ route('users.index') }}" role="button">Back</a>
  <a class="btn btn-secondary" href="{{ route('users.edit', $user) }}" role="button">Edit</a>
</div>
@endsection
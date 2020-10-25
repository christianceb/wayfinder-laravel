@extends('layouts.app')

@section('title')
Floor Plans: Browse
@endsection

@section('content')
<div class="container">
  <h1>Floor Plans</h1>
  <div class="mt-2 mb-3">
    <a href="{{ route('floors.create') }}" class="btn btn-success">
      Add Floor Plan
    </a>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Order</th>
        <th scope="col">Building</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($floors as $floor)
      <tr>
        <td>{{$floor->id}}</td>
        <td>{{$floor->name}}</td>
        <td>{{$floor->order}}</td>
        <td>{{$floor->location->name}}</td>
        <td>
          <form action="{{route('floors.destroy', $floor)}}" method="post">
            @csrf
            @method('delete')
            <a href="{{ route('floors.show', $floor) }}" class="btn btn-primary">Show</a>

            <a href="{{ route('floors.edit', $floor) }}" class="btn btn-secondary">Edit</a>

            <button type="submit" class="btn btn-danger" data-confirm-delete>Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
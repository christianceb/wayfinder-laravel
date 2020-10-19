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
        <th scope="col">Level</th>
        <th scope="col">Order</th>
        <th scope="col">Building</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach($locations as $location)
      <tr>
        <td>{{$location->id}}</td>
        <td>{{$location->name}}</td>
        <td>{{$location->typeName}}</td>
        <td>{{$location->parent->name ?? "-"}}</td>
        <td>
          <form action="/locations/{{$location->id}}" method="post">
            @csrf
            @method('delete')
            <a href="{{ route('locations.show', $location) }}" class="btn btn-primary">Show</a>

            <a href="{{ route('locations.edit', $location) }}" class="btn btn-secondary">Edit</a>

            <button type="submit" class="btn btn-danger" data-confirm-delete>Delete</button>
          </form>
        </td>
      </tr>
      @endforeach --}}
    </tbody>
  </table>
</div>
@endsection
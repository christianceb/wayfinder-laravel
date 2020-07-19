@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events</h1>

  <div class="mt-2 mb-3">
    <a class="btn btn-success" href="{{ route('events.create') }}">
      Add Event
    </a>
  </div>

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Location</th>
        <th scope="col">Start</th>
        <th scope="col">End</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>

    <tbody>
      @foreach($events as $event)
      <tr>
        <td>{{ $event->title }}</td>
        <td>{{ $event->location->name}}</td>
        <td>{{ $event->start }}</td>
        <td>{{ $event->end }}</td>
        <td>
          <form action="{{route('events.destroy', $event)}}" method="post">
            @csrf
            @method('DELETE')
            <a class="btn btn-primary" href="{{route('events.show', $event)}}">Show</a>
            <a class="btn btn-secondary" href="{{route('events.edit', $event)}}">Edit</a>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
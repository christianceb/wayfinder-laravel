@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events: Show</h1>

  @if ($events->attachment)
    <div class="row">
      <img src="{{ $events->attachment->url }}" alt="{{$events->attachment->title}}">
    </div>
  @endif

  <table class="table">
    <tbody>
      <tr>
        <th scope="col" class="text-primary">Title</th>
        <td>{{$events->title}}</td>
      <tr>
      <tr>
        <th scope="col" class="text-primary">Description</th>
        <td>{{$events->description}}</td>
      <tr>
      <tr>
        <th scope="col" class="text-primary">Location</th>
        <td>{{$events->location->name}}</td>
      </tr>
      <tr>
        <th scope="col" class="text-primary">Start</th>
        <td>{{$events->start}}</td>
      </tr>
      <tr>
        <th scope="col" class="text-primary">End</th>
        <td>{{$events->end}}</td>
      </tr>
    </tbody>
  </table>
  <div>
    <form action="/events/{{$events->id}}" method="post">
      @csrf
      @method('delete')

      <a href="{{url("/events")}}" class="btn btn-primary">
        Back
      </a>

      <a href="{{url("/events/{$events->id}/edit")}}" class="btn btn-secondary">
        Edit
      </a>

      <button type="submit" class="btn btn-danger">
        Delete
      </button>
    </form>
  </div>
</div>
@endsection

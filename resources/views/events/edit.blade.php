@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events: Edit</h1>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{route('events.update', $events)}}" method="post">
    @csrf
    @method('patch')

    <div class="form-group">
      <labe>Title</labe>
      <input type="text" name="title" value="{{ $events->title }}" class="form-control">
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" name="description">{{$events->description}}</textarea>
    </div>

    <div class="form-group">
      <label>Location</label>
      <select id="eventLocation" class="form-control" name="location_id">
        <option selected disabled>Choose...</option>
        <optgroup label="Campus">
          @foreach($locations["campus"] as $location)
          <option value="{{$location->id}}" @if($events->location_id === $location->id) selected @endif>
            {{$location->name}}</option>
          @endforeach
        </optgroup>
        <optgroup label="Building">
          @foreach($locations["building"] as $location)
          <option value="{{$location->id}}" @if($events->location_id === $location->id) selected @endif>
            {{$location->name}}</option>
          @endforeach
        </optgroup>
        <optgroup label="Room">
          @foreach($locations["room"] as $location)
          <option value="{{$location->id}}" @if($events->location_id === $location->id) selected @endif>
            {{$location->name}}</option>
          @endforeach
        </optgroup>
      </select>
    </div>

    <div class="form-group">
      <label>Start</label>
      <input type="text" name="start" value="{{ $events->start }}" class="form-control" data-flatpickr-datetime />
    </div>

    <div class="form-group">
      <label>End</label>
      <input type="text" name="end" value="{{ $events->end }}" class="form-control" data-flatpickr-datetime />
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{ url('/events')}}">Cancel</a>
  </form>
</div>
@endsection
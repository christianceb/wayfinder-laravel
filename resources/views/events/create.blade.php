@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events: Add</h1>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{route('events.store')}}" method="post">
    @csrf

    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" placeholder="Enter Title here.." />
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" name="description" placeholder="Enter Description here.."></textarea>
    </div>

    <div class="form-group">
      <label>Location</label>
      <select id="eventLocation" class="form-control" name="location_id">
        <option selected disabled>Choose...</option>
        <optgroup label="Campus">
          @foreach($locations["campus"] as $location)
          <option value="{{$location->id}}">{{$location->name}}</option>
          @endforeach
        </optgroup>
        <optgroup label="Building">
          @foreach($locations["building"] as $location)
          <option value="{{$location->id}}">{{$location->name}}</option>
          @endforeach
        </optgroup>
        <optgroup label="Room">
          @foreach($locations["room"] as $location)
          <option value="{{$location->id}}">{{$location->name}}</option>
          @endforeach
        </optgroup>
      </select>
    </div>

    <div class="form-group">
      <label>Start</label>
      <input class="form-control" type="text" name="start" data-flatpickr-datetime />
    </div>

    <div class="form-group">
      <label>End</label>
      <input class="form-control" type="text" name="end" data-flatpickr-datetime />
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{ url('/events')}}">Cancel</a>
  </form>
</div>
@endsection
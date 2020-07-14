@extends('layouts.app')

@section('title')
Locations: Update
@endsection

@section('content')
<div class="container">
  <h2>Locations: Edit</h2>
  
  <form action="/locations/{{$location->id}}" method="post">
    @csrf
    @method('patch')
    
    <div class="form-group">
      <label for="locationsName">Name</label>
      <input type="text" id="locationsName" name="name" class="form-control" aria-describedby="locationsHelp" placeholder="Enter Location name here.." value="{{$location->name}}">
      <small id="locationsHelp" class="form-text text-muted">
        Locations Name can not be longer than 50 character.
      </small>
    </div>
    
    <div class="form-group">
      <label for="locationsType">Type</label>

      <select id="locationsType" class="form-control location-type" name="type" data-resource="{{ route("locations.type") }}">
        @foreach ($types as $index => $type)
          <option value="{{$index}}" @if($index === $location->type) selected @endif>{{$type}}</option>
        @endforeach
      </select>

      <small id="locationsHelp" class="form-text text-muted">
        Locations Type must not be empty.
      </small>
    </div>
    
    <div class="text-center spinner">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div class="form-group location-parent">
      <label>Located At</label>
      <select class="form-control" name="parent_id" data-original-value="{{$location->parent_id}}" data-current-location="{{$location->id}}"></select>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('locations.index') }}" class="btn btn-danger">Cancel</a>
  </form>
</div>
@endsection

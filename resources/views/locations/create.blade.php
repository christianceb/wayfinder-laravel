@extends('layouts.app')

@section('title')
Locations: Create
@endsection

@section('content')
<div class="container">
  <h2>Locations: Create</h2>

  <form action="/locations" method="post">
    @csrf
    @method('post')

    <div class="form-group">
      <label for="locationsName">Name</label>
      <input type="text" id="locationsName" name="name" class="form-control" aria-describedby="locationsHelp" placeholder="Enter Location name here.." value="">
      <small id="locationsHelp" class="form-text text-muted">
        Locations Name can not be longer than 50 character.
      </small>
    </div>

    <div class="form-group">
      <label for="locationsType">Type</label>
      
      <select id="locationsType" class="form-control location-type" name="type" data-resource="{{ route("locations.type") }}">
        <option selected disabled>Choose...</option>

        @foreach ($types as $index => $type)
          <option value="{{$index}}">{{$type}}</option>
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
      <label for="locationsParent">Located At</label>
      <select id="locationsParent" class="form-control" name="parent"></select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{url('/locations')}}" class="btn btn-danger">Cancel</a>
  </form>
</div>
@endsection
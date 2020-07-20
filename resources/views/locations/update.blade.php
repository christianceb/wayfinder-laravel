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

    <div class="form-group">
      <label>Attachment</label>
      <div class="dropzone-previews" id="upload-preview"></div>
      <input type="file" data-upload-attachment data-upload-endpoint="{{ route("uploads.store") }}" data-upload-csrf="{{ csrf_token() }}" accept="image/*" />
      <input type="hidden" id="attachment_id" name="upload_id" value="{{ old('upload_id', $location->attachment->id) }}" data-upload-query-url="{{ route("uploads.id") }}" />
    </div>
    
    <div class="form-group">
      <label>Map</label>
      <select id="geolocate"></select>
      <div id="leaflet" class="leaflet" data-zoom="15" data-mp-id="{{old('mp_id', $location->mp_id)}}" data-mp-type="{{old('mp_type', $location->mp_type)}}"></div>
    </div>

    <div class="form-group">
      <label>Address</label>
      <input type="text" class="form-control" name="address" value="{{old('address', $location->address)}}" />
    </div>

    <input type="hidden" name="mp_id" value="{{old('mp_id', $location->mp_id)}}" />
    <input type="hidden" name="mp_type" value="{{old('mp_type', $location->mp_type)}}" />

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('locations.index') }}" class="btn btn-danger">Cancel</a>
  </form>
</div>
@endsection

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
      <input type="text" id="locationsName" name="name" class="form-control" aria-describedby="locationsHelp" placeholder="Enter Location name here.." value="{{old("name", $location->name)}}" required>

      @error('name')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    
    <div class="form-group">
      <label for="locationsType">Type</label>

      <select id="locationsType" class="form-control location-type" name="type" data-resource="{{ route("locations.type") }}" required>
        @foreach ($types as $index => $type)
          <option value="{{$index}}" @if ((old('type') ?? $location->type) == $index) selected @endif>{{$type}}</option>
        @endforeach
      </select>

      @error('type')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    
    <div class="text-center spinner">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div class="form-group location-parent">
      <label>Located At</label>
      <select class="form-control" name="parent_id" data-original-value="{{$location->parent_id}}" data-current-location="{{$location->id}}">
        {{-- will be programmatically filled by JS ;) --}}
      </select>

      @error('parent_id')
        <div class="text-danger">There was a problem processing your selected parent location</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Attachment</label>
      <div class="dropzone-previews" id="upload-preview"></div>
      <input type="file" data-upload-attachment data-upload-endpoint="{{ route("uploads.store") }}" data-upload-csrf="{{ csrf_token() }}" accept="image/*" />
      <input type="hidden" id="attachment_id" name="upload_id" value="{{ old('upload_id', $location->attachment->id ?? null) }}" data-upload-query-url="{{ route("uploads.id") }}" />

      @error('upload_id')
        <div class="text-danger">There was a problem processing your selected attachment</div>
      @enderror
    </div>
    
    <div class="form-group">
      <label>Map</label>
      <select id="geolocate"></select>
      <div id="leaflet" class="leaflet" data-zoom="15" data-mp-id="{{old('mp_id', $location->mp_id)}}" data-mp-type="{{old('mp_type', $location->mp_type)}}"></div>

      @if ($errors->has('mp_id') || $errors->has('mp_type'))
        <div class="text-danger">There was a problem using the map location</div>
      @endif
    </div>

    <div class="form-group">
      <label>Address</label>
      <input type="text" class="form-control" name="address" value="{{old('address', $location->address)}}" />

      @error('address')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <input type="hidden" name="mp_id" value="{{old('mp_id', $location->mp_id)}}" />
    <input type="hidden" name="mp_type" value="{{old('mp_type', $location->mp_type)}}" />

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('locations.index') }}" class="btn btn-danger">Cancel</a>
  </form>
</div>
@endsection

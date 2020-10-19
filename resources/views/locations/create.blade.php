@extends('layouts.app')

@section('title')
Locations: Create
@endsection

@section('content')
<div class="container">
  <h2>Locations: Add</h2>

  <form action="/locations" method="post">
    @csrf

    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter Location name here.." value="{{old("name")}}" required>

      @error('name')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="locationsType">Type</label>

      <select id="locationsType" class="form-control location-type" name="type" data-resource="{{ route("locations.type") }}" required>
        <option selected disabled>Choose...</option>

        @foreach ($types as $index => $type)
          <option value="{{$index}}" @if(old('type') == $index) selected @endif>{{$type}}</option>
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
      <label>Location in Campus</label>
      <select class="form-control" name="parent_id" data-original-value="{{old('parent_id')}}">
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
      <input type="hidden" id="attachment_id" name="upload_id" value="{{ old('upload_id') }}" data-upload-query-url="{{ route("uploads.id") }}" />

      @error('upload_id')
        <div class="text-danger">There was a problem processing your selected attachment</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Map</label>
      <div id="mapbox" class="mapbox" data-geocoding="true" data-lat="{{old('mp_lat')}}" data-lng="{{old('mp_lng')}}"></div>
      <small class="text-muted">Search for addresses using the search bar on the map. Click a point in the map to accurately set the pin.</small>

      @if ($errors->has('mp_id') || $errors->has('mp_type'))
        <div class="text-danger">There was a problem using the map location.</div>
      @endif
    </div>

    <div class="form-group">
      <label>Address</label>
      <input type="text" class="form-control" name="address" value="{{old('address')}}" />
      <small class="text-muted">Updated automatically once you set a point in the map. Change as needed</small>

      @error('address')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-row my-3">
      <div class="col-4">
        <label>Map Provider Id</label>
        <input type="text" class="form-control" name="mp_id" value="{{old('mp_id')}}" readonly>
      </div>
      <div class="col-4">
        <label>Map Provider Longitude</label>
        <input type="text" class="form-control" name="mp_lng" value="{{old('mp_lng')}}" readonly>
      </div>
      <div class="col-4">
        <label>Map Provider Latitude</label>
        <input type="text" class="form-control" name="mp_lat" value="{{old('mp_lat')}}" readonly>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('locations.index') }}" class="btn btn-danger">Cancel</a>
  </form>
</div>
@endsection

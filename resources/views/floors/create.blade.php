@extends('layouts.app')

@section('title')
Floor plans: Create
@endsection

@section('content')
<div class="container floor-plan">
  <h2>Add a new floor plan</h2>

  <form action="{{route('floors.store')}}" method="post">
    @csrf

    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter floor name here" value="{{old("name")}}" required>

      @error('name')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
        <label>Order</label>
        <input type="number" name="order" class="form-control" placeholder="Order of floor in building. 0 means main floor" required>
  
        @error('name')
          <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Building</label>

        <select id="building" name="location_id" class="form-control">
            <option disabled hidden selected></option>

            @forelse ($buildings as $building)
              <option value="{{$building->id}}" data-lng="{{$building->mp_lng}}" data-lat="{{$building->mp_lat}}">
                {{ $building->name . " - (" . $building->parent->name . ")" }}
              </option>
            @empty
              <option disabled>The system does not have buildings that have their coordinates set. Please set them first on the building page.</option>
            @endforelse
        </select>

        @error('location_id')
          <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Attachment</label>
  
        <div class="dropzone-previews" id="upload-preview"></div>
        <input type="file" data-upload-attachment-fp data-upload-endpoint="{{ route("uploads.store") }}" data-upload-csrf="{{ csrf_token() }}" accept="image/*" />
        <input type="hidden" id="attachment_id" name="upload_id" value="{{ old('upload_id') }}" data-upload-query-url="{{ route("uploads.id") }}" required />
  
        @error('upload_id')
          <div class="text-danger">There was a problem processing your selected attachment</div>
        @enderror
    </div>

    <div class="form-group">
      <label>Map</label>
      <div id="mapbox" class="mapbox" data-floor-designer="true"></div>
    </div>

    <div class="form-row">
      <div class="col-4">
        <label for="mapbox-layer-opacity">Opacity Control</label>
        <input id="mapbox-layer-opacity" class="form-control" type="range" min="0" max="100" value="100" />
      </div>
    </div>

    <div class="form-row my-3">
      <div class="col-3">
        <label>NE Longitude</label>
        <input type="text" class="form-control" name="ne_lng" value="{{old('ne_lng')}}" readonly required>
        @error('ne_lng')
          <div class="text-danger">{{$message}}</div>
        @enderror
      </div>
      <div class="col-3">
        <label>NE Latitude</label>
        <input type="text" class="form-control" name="ne_lat" value="{{old('ne_lng')}}" readonly required>
        @error('ne_lat')
          <div class="text-danger">{{$message}}</div>
        @enderror
      </div>
      <div class="col-3">
        <label>SW Longitude</label>
        <input type="text" class="form-control" name="sw_lng" value="{{old('sw_lng')}}" readonly required>
        @error('sw_lng')
          <div class="text-danger">{{$message}}</div>
        @enderror
      </div>
      <div class="col-3">
        <label>SW Latitude</label>
        <input type="text" class="form-control" name="sw_lat" value="{{old('sw_lat')}}" readonly required>
        @error('sw_lat')
          <div class="text-danger">{{$message}}</div>
        @enderror
      </div>
    </div>

    <button type="submit" class="btn btn-primary"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Submit</button>
    <a href="{{ route('locations.index') }}" class="btn btn-danger">Cancel</a>
  </form>
</div>
@endsection

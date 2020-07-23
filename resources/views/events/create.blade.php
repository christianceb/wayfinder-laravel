@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events: Add</h1>

  <form action="{{route('events.store')}}" method="post">
    @csrf

    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" placeholder="Enter Title here.." value="{{old('title')}}" required />

      @error('title')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" name="description" placeholder="Enter Description here..">{{old('description')}}</textarea>

      @error('description')
        <div class="text-danger">{{$description}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Location</label>
      <select id="eventLocation" class="form-control" name="location_id" required>
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

      @error('location_id')
        <div class="text-danger">{{$description}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Start</label>
      <input class="form-control" type="text" name="start" value="{{old('start')}}" data-datetime-picker required/>

      @error('start')
        <div class="text-danger">{{$description}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>End</label>
      <input class="form-control" type="text" name="end" value="{{old('end')}}" data-datetime-picker required/>

      @error('end')
        <div class="text-danger">{{$description}}</div>
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

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{ route('events.index') }}">Cancel</a>
  </form>
</div>
@endsection
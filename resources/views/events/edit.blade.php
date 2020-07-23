@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events: Edit</h1>

  <form action="{{route('events.update', $event)}}" method="post">
    @csrf
    @method('patch')

    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-control" required />

      @error('title')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" name="description">{{old('description', $event->description)}}</textarea>

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
            <option value="{{$location->id}}" @if($event->location_id === $location->id) selected @endif>
              {{$location->name}}
            </option>
          @endforeach
        </optgroup>
        
        <optgroup label="Building">
          @foreach($locations["building"] as $location)
            <option value="{{$location->id}}" @if($event->location_id === $location->id) selected @endif>
              {{$location->name}}
            </option>
          @endforeach
        </optgroup>
        
        <optgroup label="Room">
          @foreach($locations["room"] as $location)
            <option value="{{$location->id}}" @if($event->location_id === $location->id) selected @endif>
              {{$location->name}}
            </option>
          @endforeach
        </optgroup>
      </select>

      @error('location_id')
        <div class="text-danger">{{$description}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Start</label>
      <input type="text" name="start" value="{{ old('start', $event->start) }}" class="form-control" data-datetime-picker required/>

      @error('start')
        <div class="text-danger">{{$description}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>End</label>
      <input type="text" name="end" value="{{ old('end', $event->end) }}" class="form-control" data-datetime-picker required/>

      @error('end')
        <div class="text-danger">{{$description}}</div>
      @enderror
    </div>

    <div class="form-group">
      <label>Attachment</label>

      <div class="dropzone-previews" id="upload-preview"></div>
      <input type="file" data-upload-attachment data-upload-endpoint="{{ route("uploads.store") }}" data-upload-csrf="{{ csrf_token() }}" accept="image/*" />
      <input type="hidden" id="attachment_id" name="upload_id" value="{{ old('upload_id', $event->attachment->id ?? null) }}" data-upload-query-url="{{ route("uploads.id") }}" />

      @error('upload_id')
        <div class="text-danger">There was a problem processing your selected attachment</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="{{ route('events.index') }}">Cancel</a>
  </form>
</div>
@endsection
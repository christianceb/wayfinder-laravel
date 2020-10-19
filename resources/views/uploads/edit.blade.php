@extends('layouts.app')

@section('title')
  Uploads: Edit
@endsection

@section('content')
  <div class="container">
    <h1>Uploads: Edit</h1>

    <div class="row">

      <div class="col-6">
        <img src="{{$upload->url}}" alt="{{$upload->title}}" class="mw-100" />
      </div>

      <div class="col-6">
        <form method="POST" action="{{ route('uploads.update', $upload) }}">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="{{old('title', $upload->title)}}" required>

            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>URI</label>
            <input type="text" class="form-control" value="{{$upload->uri}}" readonly>
          </div>

          <div class="form-group">
            <label>File name</label>
            <input type="text" class="form-control" value="{{$upload->filename}}" readonly>
          </div>

          <div class="form-group">
            <label>URL</label>
            <input type="text" class="form-control" value="{{$upload->url}}" readonly>
          </div>

          <div class="form-group">
            <label>Size</label>
            <input type="text" class="form-control" value="{{$upload->sizeInKb}} KB" readonly>
          </div>

          <div class="form-group">
            <label>Type</label>
            <input type="text" class="form-control" value="{{$upload->mime_type}}" readonly>
          </div>

          <div class="form-group">
            <label>Created at</label>
            <input type="text" class="form-control" value="{{$upload->created_at}}" readonly>
          </div>

          <div class="form-group">
            <label>Last updated</label>
            <input type="text" class="form-control" value="{{$upload->updated_at}}" readonly>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
          <a class="btn btn-danger" href="{{ route('uploads.show', $upload) }}" role="button">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection()

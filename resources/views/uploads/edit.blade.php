@extends('layouts.app')

@section('title')
  Uploads: Edit
@endsection

@section('content')
  <div class="container">
    <h1>Uploads: Edit</h1>

    <a class="btn btn-success" href="{{ route('uploads.show', $upload) }}" role="button">Back to Upload</a>

    <div class="row">
      <div class="col-2">
        <img src="{{$upload->url}}" alt="{{$upload->title}}" />
      </div>
      <div class="col-10">
        <form method="POST" action="{{ route('uploads.update', $upload) }}">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$upload->title}}" required>

            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>MIME Type</label>
            <input type="text" class="form-control" value="{{$upload->mime_type}}" disabled>
          </div>

          <div class="form-group">
            <label>Created at</label>
            <input type="text" class="form-control" value="{{$upload->created_at}}" disabled>
          </div>

          <div class="form-group">
            <label>Last updated</label>
            <input type="text" class="form-control" value="{{$upload->updated_at}}" disabled>
          </div>


          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection()
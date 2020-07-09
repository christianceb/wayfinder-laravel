@extends('layouts.app')

@section('title')
  Uploads: Create
@endsection

@section('content')
  <div class="container">
    <h1>Uploads: Create</h1>

    <form method="POST" action="{{ route('uploads.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>File</label>
        <input type="file" name="file" accept="image/*" class="form-control-file">
      </div>

      @error('file')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      @error('title')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      @error('mime_type')
        <div class="text-danger">{{ $message }}</div>
      @enderror

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>
@endsection()
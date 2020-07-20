@extends('layouts.app')

@section('title')
  Uploads: View
@endsection

@section('content')
  <div class="container">
    <h1>Uploads: Show</h1>

    <div class="row">
      <div class="col-8">
        <img src="{{$upload->url}}" alt="{{$upload->title}}" />
      </div>
      <div class="col-4">
        <strong>{{$upload->title}}</strong>

        <dl>
          <dt>URI</dt>
          <dd>{{$upload->uri}}</dd>

          <dt>MIME Type</dt>
          <dd>{{$upload->mime_type}}</dd>

          <dt>Created at</dt>
          <dd>{{$upload->created_at}}</dd>

          <dt>Last updated</dt>
          <dd>{{$upload->updated_at}}</dd>

        </dl>

        <form method="POST" action="{{ route('uploads.destroy', $upload) }}">
          @csrf
          @method("DELETE")
            <a class="btn btn-primary" href="{{ route('uploads.index') }}" role="button">Back</a>
            <a class="btn btn-secondary" href="{{ route('uploads.edit', $upload) }}" role="button">Edit</a>
          <button type="submit" class="btn btn-danger" data-confirm-delete>Delete</button>
        </form>
      </div>
    </div>
  </div>
@endsection()

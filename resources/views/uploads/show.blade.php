@extends('layouts.app')

@section('title')
  Uploads: View
@endsection

@section('content')
  <div class="container">
    <h1>Uploads: Show</h1>

    <div class="row">
      <div class="col-6">
        <img src="{{$upload->url}}" alt="{{$upload->title}}" class="mw-100" />
      </div>

      <div class="col-6">
        <table class="table">
          <tbody>
            <tr>
              <th class="text-primary">ID</th>
              <td>{{$upload->id}}</td>
            </tr>
            <tr>
              <th class="text-primary">Title</th>
              <td>{{$upload->title}}</td>
            </tr>
            <tr>
              <th class="text-primary">URI</th>
              <td><input type="text" class="form-control" value="{{$upload->uri}}" readonly></td>
            </tr>
            <tr>
              <th class="text-primary">File name</th>
              <td><input type="text" class="form-control" value="{{$upload->filename}}" readonly></td>
            </tr>
            <tr>
              <th class="text-primary">URL</th>
              <td><input type="text" class="form-control" value="{{$upload->url}}" readonly></td>
            </tr>
            <tr>
              <th class="text-primary">Size</th>
              <td>{{$upload->sizeInKb}} KB</td>
            </tr>
            <tr>
              <th class="text-primary">Type</th>
              <td>{{$upload->mime_type}}</td>
            </tr>
            <tr>
              <th class="text-primary">Created at</th>
              <td>{{$upload->created_at}}</td>
            </tr>
            <tr>
              <th class="text-primary">Last updated</th>
              <td>{{$upload->updated_at}}</td>
            </tr>
          </tbody>
        </table>

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

@extends('layouts.app')

@section('title')
  Uploads
@endsection

@section('content')
  <div class="container">
    <h1>Uploads</h1>

    <a class="btn btn-success" href="{{ route('uploads.create') }}" role="button">Add</a>

    <table class="table">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Title</th>
          <th scope="col">MIME Type</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($uploads as $upload)
          <tr>
            <th scope="row"><img src="{{$upload->url}}" /></th>
            <td><?= $upload->title ?></td>
            <td><?= $upload->mime_type ?></td>
            <td>
              <a class="btn btn-primary" href="{{ route('uploads.show', $upload) }}" role="button">View</a>
              <a class="btn btn-secondary" href="{{ route('uploads.edit', $upload) }}" role="button">Edit</a>
              <form method="POST" action="{{ route('uploads.destroy', $upload) }}">
                @csrf
                @method("DELETE")
                <button type="submit" id='Confirm-Delete' class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4">No uploads yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection()
@extends('layouts.app')


@section('content')

<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Admins</h1> 
    <div>
        <a href="{{route('Admin.create')}}" class="btn btn-primary">Create</a>
    </div>   
  <table class="table responsive">
    <thead>
        <tr>
          <td>Id</td>
          <td>Name</td>
          <td>Email</td>
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($admin as $admins)
        <tr>
            <td>{{$admins->id}}</td>
            <td>{{$admins->name}}</td>
            <td>{{$admins->email}}</td>
            <td>
                <form action="{{ route('Admin.destroy', $admins->id)}}" method="post">
                <a href="{{ route('Admin.show', $admins->id)}}" class="btn btn-primary">Show</a>
                <a href="{{ route('Admin.edit', $admins->id)}}" class="btn btn-warning">Edit</a>
                  @csrf 
                  @method('delete')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>

@endsection
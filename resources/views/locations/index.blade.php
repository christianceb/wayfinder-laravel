@extends('layouts.app')

@section('title')
    Locations: Browse
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Browse Locations</h1>
        <div class="mt-3 mb-3">
            <a href="{{url("/locations/create")}}" class="btn btn-success">
                Create
            </a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Locations as $location)
                <tr>
                    <td>{{$location->id}}</td>
                    <td>{{$location->name}}</td>
                    <td>
                        {{App\Locations::getType($location->type)}}
                    </td>
                    <td>
                        <form action="/feedbackSubjects/{{$location->id}}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{url("/locations/{$location->id}")}}" class="btn btn-info">
                                Show
                            </a>

                            <a href="{{url("/locations/{$location->id}/edit")}}" class="btn btn-warning">
                                Edit
                            </a>

                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

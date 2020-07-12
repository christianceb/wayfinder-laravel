@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2>Events</h2>
        <a class="btn btn-primary" href="{{ url('/events/create')}}">Create Event</a>
    </div>
</div>

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif

<table class="table table-borderless">
<thead>
    <tr>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">location</th>
        <th scope="col">start</th>
        <th scope="col">end</th>
    </tr>
</thead>
<tbody>
    @foreach($events as $event) 
    <tr>

            <td>{{ $event->title }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ $event->location }}</td>
            <td>{{ $event->start }}</td>
            <td>{{ $event->end }}</td>
            <td>

                <form action="{{route('events.destroy', $event->id)}}" method="post">
                @csrf
                @method('DELETE')
                <a class="btn btn-info" href="{{route('events.show', $event->id)}}">Show</a>
                <a class="btn btn-primary" href="{{url('events.edit', $event->id)}}">Edit</a>

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

</table>
@endsection
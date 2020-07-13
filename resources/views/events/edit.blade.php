@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Event Edit</h2>
            </div>
            <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('/events')}}">back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('events.update', $events->ID)}}" method="post">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $events->title }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>description:</strong>
                    <textarea class="form-control" name="description">{{$events->description}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Location:</strong>
                    <select id="eventLocation" class="form-control" name="location_id" >
                        <option selected disabled>Choose...</option>
                        <optgroup label="Campus">
                            @foreach($locations->where('type', 0) as $location)
                                <option value="{{$location->id}}"
                                        @if($events->location_id === $location->id) selected @endif>
                                    {{$location->name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Building">
                            @foreach($locations->where('type', 1) as $location)
                                <option value="{{$location->id}}"
                                        @if($events->location_id === $location->id) selected @endif>
                                    {{$location->name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Room">
                            @foreach($locations->where('type', 2) as $location)
                                <option value="{{$location->id}}"
                                        @if($events->location_id === $location->id) selected @endif>
                                    {{$location->name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start:</strong>
                    <input type="datetime-local" name="start" value="{{ $events->start }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start:</strong>
                    <input type="datetime-local" name="end" value="{{ $events->end }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection

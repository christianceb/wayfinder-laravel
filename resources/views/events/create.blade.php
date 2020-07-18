@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Event</h2>
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

<form action="{{route('events.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="title" />
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" placeholder="description"></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Location:</strong>
                <select id="eventLocation" class="form-control" name="location_id" >
                    <option selected disabled>Choose...</option>
                    <optgroup label="Campus">
                        @foreach($locations["campus"] as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Building">
                        @foreach($locations["building"] as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Room">
                        @foreach($locations["room"] as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start:</strong>
                <input class="form-control" type="text" name="start" data-flatpickr-datetime />
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End:</strong>
                <input class="form-control" type="text" name="end" data-flatpickr-datetime />
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

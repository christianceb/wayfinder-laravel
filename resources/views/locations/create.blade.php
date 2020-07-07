@extends('layouts.app')

@section('title')
    Locations: Create
@endsection

@section('content')
    <div class="container">
        <h2>Locations: Create</h2>

        <form action="/locations" method="post">
            @csrf
            @method('post')

            <div class="form-group">
                <label for="locationsName">Name</label>
                <input type="text" id="locationsName" name="locationsName"
                       class="form-control" aria-describedby="locationsHelp"
                       placeholder="Enter Location name here.."
                       value="">
                <small id="locationsHelp" class="form-text text-muted">
                    Locations Name can not be longer than 50 character.
                </small>
            </div>

            <div class="form-group">
                <label for="locationsType">Type</label>
                <select id="locationsType" class="form-control" name="locationsType">
                    <option selected>Choose...</option>
                    <option value="0">Campus</option>
                    <option value="1">Building</option>
                    <option value="2">Room</option>
                </select>
                <small id="locationsHelp" class="form-text text-muted">
                    Locations Type must not be empty.
                </small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{url('/locations')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
@endsection

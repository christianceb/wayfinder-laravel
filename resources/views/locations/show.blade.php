@extends('layouts.app')

@section('title')
Locations: Show
@endsection

@section('content')
<div class="container">
	<h1>Locations: Show</h1>

  <div class="row mb-3">
    @if ($location->attachment)
      <div class="col-6">
        @include('locations.show.attachment')
      </div>
    @endif

    @if ($location->attachment !== null)
      <div class="col-6">
        @include('locations.show.content')
      </div>
    @else
      <div class="col">
        @include('locations.show.content')
      </div>
    @endif
  </div>

  @if ($location->mp_id)
    <div class="row mb-3">
      <div class="col">
        @include("locations.show.map")
      </div>
    </div>
  @endif

  <div class="row">
    @if (!empty($location->children))
      <div class="col-6">
        <h2>Locations under this location</h2>
        @include("locations.show.children")
      </div>
    @endif

    @if (!empty($location->events))
      <div class="col-6">
        <h2>Upcoming events on location</h2>
        @include("locations.show.events")
      </div>
    @endif
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Events: Show</h1>

  <div class="row mb-3">
    @if ($event->attachment)
      <div class="col-6">
        @include('events.show.attachment')
      </div>
    @endif

    @if ($event->attachment !== null)
      <div class="col-6">
        @include('events.show.content')
      </div>
    @else
      <div class="col">
        @include('events.show.content')
      </div>
    @endif
  </div>

  @if ($event->location->mp_id)
    <div class="row">
      <div class="col">
        @include("events.show.map")
      </div>
    </div>
  @endif
</div>
@endsection

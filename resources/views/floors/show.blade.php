@extends('layouts.app')

@section('title')
Floor plans: Show
@endsection

@section('content')
<div class="container floor-plan">
  <h2>Floor plan</h2>

  <table class="table mb-3">
    <tr>
      <th>Id</th>
      <td>{{$floor->id}}</td>
    </tr>
    <tr>
      <th>Name</th>
      <td>{{$floor->name}}</td>
    </tr>
    <tr>
      <th>Order</th>
      <td>{{$floor->order}}</td>
    </tr>
    <tr>
      <th>Map Overlay</th>
      <td><a href="{{route('uploads.show', $floor->attachment)}}">View map on page</a></td>
    </tr>
    <tr>
      <th>Created</th>
      <td>{{$floor->created_at}}</td>
    </tr>
    <tr>
      <th>Updated</th>
      <td>{{$floor->updated_at}}</td>
    </tr>
  </table>

  <div class="row mb-3">
    <div class="col">
      <div
        id="mapbox"
        class="mapbox"
        data-sw-lng="{{$floor->sw_lng}}"
        data-sw-lat="{{$floor->sw_lat}}"
        data-ne-lng="{{$floor->ne_lng}}"
        data-ne-lat="{{$floor->ne_lat}}"
        data-overlay="{{$floor->attachment->url}}"
        data-render-floorplan-no-interact="true">
      </div>
    </div>
  </div>
</div>
@endsection

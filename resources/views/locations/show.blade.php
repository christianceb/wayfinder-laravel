@extends('layouts.app')

@section('title')
Locations: Show
@endsection

@section('content')
<div class="container">
	<h1>Locations: Show</h1>

	@if ($location->attachment)
		<div class="row">
			<div class="col">
				<img src="{{ $location->attachment->url }}" alt="{{$location->attachment->title}}">
			</div>
		</div>
	@endif

	@if ($location->mp_id)
		<div class="row">
			<div class="col">
				<div id="leaflet" class="leaflet" data-zoom="15" data-mp-id="{{$location->mp_id}}" data-mp-type="{{$location->mp_type}}" data-no-pin-move></div>
			</div>
		</div>
	@endif

	<table class="table">
		<tbody>
			<tr>
				<th scope="col" class="text-primary">Id</th>
				<td>{{$location->id}}</td>
			<tr>
			<tr>
				<th scope="col" class="text-primary">Name</th>
				<td>{{$location->name}}</td>
			<tr>
			<tr>
				<th scope="col" class="text-primary">Type</th>
				<td>{{$location->typeName}}</td>
			</tr>
			<tr>
					<th scope="col" class="text-primary">Located At</th>
					<td>
						@isset($location->parent)
							<a href="{{route('locations.show', $location->parent)}}">{{$location->parent->name}}</a>
						@else
							-
						@endisset
					</td>
					
			</tr>
			<tr>
				<th scope="col" class="text-primary">Address</th>
				<td>{{$location->address}}</td>
			</tr>
			<tr>
				<th scope="col" class="text-primary">Created</th>
				<td>{{$location->created_at}}</td>
			</tr>
			<tr>
				<th scope="col" class="text-primary">Updated</th>
				<td>{{$location->updated_at}}</td>
			</tr>
		</tbody>
	</table>
	<div>
		<form action="/locations/{{$location->id}}" method="post">
			@csrf
			@method('delete')

			<a href="{{url("/locations")}}" class="btn btn-primary">
				Back
			</a>

			<a href="{{url("/locations/{$location->id}/edit")}}" class="btn btn-secondary">
				Edit
			</a>

			<button type="submit" class="btn btn-danger">
				Delete
			</button>
		</form>
	</div>
</div>
@endsection

@extends('layouts.app')

@section('title')
Locations: Show
@endsection

@section('content')
<div class="container">
	<h1>Locations: Show</h1>
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
				<td>{{App\Location::getType($location->type)}}</td>
			</tr>
            <tr>
                <th scope="col" class="text-primary">Located At</th>
                @if(isset($location->parent))
                    <td>{{$location->parent->name}}</td>
                @else
                    <td>{{$location->name}}</td>
                @endif
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

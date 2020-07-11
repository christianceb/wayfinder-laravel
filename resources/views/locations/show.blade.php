@extends('layouts.app')

@section('title')
Locations: Show
@endsection

@section('content')
<div class="container">
	<h2>Locations: Show</h2>
	<table class="table">
		<tbody>
			<tr>
				<th scope="col" class="text-primary">Id</th>
				<td>{{$locations->id}}</td>
			<tr>
			<tr>
				<th scope="col" class="text-primary">Name</th>
				<td>{{$locations->name}}</td>
			<tr>
			<tr>
				<th scope="col" class="text-primary">Type</th>
				<td>{{App\Location::getType($locations->type)}}</td>
			</tr>
            <tr>
                <th scope="col" class="text-primary">Located At</th>
                @if(isset($locations->parent))
                    <td>{{$locations->parent->name}}</td>
                @else
                    <td>{{$locations->name}}</td>
                @endif
            </tr>
			<tr>
				<th scope="col" class="text-primary">Created</th>
				<td>{{$locations->created_at}}</td>
			</tr>
			<tr>
				<th scope="col" class="text-primary">Updated</th>
				<td>{{$locations->updated_at}}</td>
			</tr>
		</tbody>
	</table>
	<div>
		<form action="/locations/{{$locations->id}}" method="post">
			@csrf
			@method('delete')

			<a href="{{url("/locations")}}" class="btn btn-info">
				Back
			</a>

			<a href="{{url("/locations/{$locations->id}/edit")}}" class="btn btn-warning">
				Edit
			</a>

			<button type="submit" class="btn btn-danger">
				Delete
			</button>
		</form>
	</div>
</div>
@endsection

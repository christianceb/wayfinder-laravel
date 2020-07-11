@extends('layouts.app')

@section('title')
Locations: Update
@endsection

@section('content')
<div class="container">
	<h2>Locations: Edit</h2>

	<form action="/locations/{{$locations->id}}" method="post">
		@csrf
		@method('patch')

		<div class="form-group">
			<label for="locationsName">Name</label>
			<input type="text" id="locationsName" name="locationsName" class="form-control" aria-describedby="locationsHelp" placeholder="Enter Location name here.."
				value="{{$locations->name}}">
			<small id="locationsHelp" class="form-text text-muted">
				Locations Name can not be longer than 50 character.
			</small>
		</div>

		<div class="form-group">
			<label for="locationsType">Type</label>
			<select id="locationsType" class="form-control" name="locationsType">
				<option selected value="{{$locations->type}}">{{App\Location::getType($locations->type)}}</option>
				<option value="0">Campus</option>
				<option value="1">Building</option>
				<option value="2">Room</option>
			</select>
			<small id="locationsHelp" class="form-text text-muted">
				Locations Type must not be empty.
			</small>
		</div>

        <div class="form-group">
            <label for="locationsParent">Located At</label>
            <select id="locationsParent" class="form-control" name="locationsParent">
                @if(isset($locations->parent))
                    <option selected value="{{$locations->parent_id}}">{{$locations->parent->name}}</option>
                @endif
            </select>
        </div>

		<button type="submit" class="btn btn-primary">Submit</button>
		<a href="{{url('/locations')}}" class="btn btn-danger">Cancel</a>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('change', '#locationsType', function () {
            // assign the value of locationsType to typeId
            var typeId = $(this).val();
            // assign empty string to parent variable
            var parent = " ";
            var div = $(this).parent().parent();

            $.ajax({
                type:'get',
                url:'{!!URL::to('findTypeParent')!!}',
                data:{'id': typeId},
                success:function (data) {
                    for (var i=0; i<data.length; i++)
                    {
                        parent += '<option value="'+data[i].id+'">'+data[i].name+'</option>'
                    }
                    div.find('#locationsParent').html(" ");
                    div.find('#locationsParent').append(parent);
                },
                error:function () {
                    console.log("data is empty");
                }
            });
        });
    })
</script>
@endsection

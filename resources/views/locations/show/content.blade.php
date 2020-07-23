<table class="table">
  <tbody>
    <tr>
      <th scope="col" class="text-primary">ID</th>
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
        <th scope="col" class="text-primary">Location in Campus</th>
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
  <form action="{{route('locations.destroy', $location)}}" method="post">
    @csrf
    @method('delete')

    <a href="{{route('locations.index')}}" class="btn btn-primary">Back</a>

    <a href="{{route('locations.edit', $location)}}" class="btn btn-secondary">Edit</a>

    <button type="submit" class="btn btn-danger" data-confirm-delete>Delete</button>
  </form>
</div>
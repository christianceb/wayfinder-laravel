<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  <tbody>
    @foreach($location->children as $childLocation)
    <tr>
      <td>
      <a href="{{route('locations.show', $childLocation)}}">{{$childLocation->name}}</a>
      </td>
      <td>{{$childLocation->typeName}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
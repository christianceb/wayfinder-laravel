<table class="table">
  <tbody>
    <tr>
      <th scope="col" class="text-primary">Title</th>
      <td>{{$event->title}}</td>
    <tr>
    <tr>
      <th scope="col" class="text-primary">Description</th>
      <td>{{$event->description}}</td>
    <tr>
    <tr>
      <th scope="col" class="text-primary">Location</th>
      <td>
        <a href="{{route('locations.show', $event->location)}}">{{$event->location->name}}</a>
      </td>
    </tr>
    <tr>
      <th scope="col" class="text-primary">Start</th>
      <td>{{$event->start}}</td>
    </tr>
    <tr>
      <th scope="col" class="text-primary">End</th>
      <td>{{$event->end}}</td>
    </tr>
  </tbody>
</table>

<div>
  <form action="{{route('events.destroy', $event)}}" method="post">
    @csrf
    @method('delete')

    <a href="{{route("events.index")}}" class="btn btn-primary">Back</a>

    <a href="{{route('events.edit', $event)}}" class="btn btn-secondary">Edit</a>

    <button type="submit" class="btn btn-danger" data-confirm-delete>Delete</button>
  </form>
</div>
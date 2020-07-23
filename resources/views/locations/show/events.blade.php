<table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Start</th>
    </tr>
  </thead>

  <tbody>
    @foreach($location->events as $event)
    <tr>
      <td>
        <a href="{{route('events.show', $event)}}">{{ $event->title }}</a>
      </td>
      <td>{{ $event->start }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
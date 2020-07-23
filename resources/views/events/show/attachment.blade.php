<img src="{{ $event->attachment->url }}" alt="{{$event->attachment->title}}" class="mw-100">
<div class='text-center'>
  <a href="{{route('uploads.show', $event->attachment)}}">View image on page</a>
</div>
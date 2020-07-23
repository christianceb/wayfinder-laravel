<img src="{{ $location->attachment->url }}" alt="{{$location->attachment->title}}" class="mw-100" />
<div class='text-center'>
  <a href="{{route('uploads.show', $location->attachment)}}">View image on page</a>
</div>
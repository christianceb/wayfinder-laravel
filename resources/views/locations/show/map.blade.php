<div
    id="mapbox"
    class="mapbox"
    @if ($interactive ?? '')data-interactive="false"@endif
    @if ($zoom ?? '')data-zoom="{{$zoom}}"@endif
    ></div>
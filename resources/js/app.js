require('./bootstrap');

// jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Flatpickr (datetime picker)
import flatpickr from "flatpickr";

// Dropzone
import Dropzone from "dropzone";
window.Dropzone = Dropzone;

// Mapbox
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder';
window.mapboxgl = mapboxgl;
window.MapboxGeocoder = MapboxGeocoder;

// Select2
import select2 from 'select2';
window.select2 = select2;

// Custom scripts
require('./scripts')
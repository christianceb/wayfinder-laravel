require('./bootstrap');

// jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Flatpickr (datetime picker)
import flatpickr from "flatpickr";

// Dropzone
import Dropzone from "dropzone";
window.Dropzone = Dropzone;

// Leaflet JS
import L from 'leaflet';
// LeafletJS fix for icon paths
// - https://github.com/Leaflet/Leaflet/issues/4968#issuecomment-269750768
// - https://github.com/PaulLeCam/react-leaflet/issues/255#issuecomment-388492108
import marker from 'leaflet/dist/images/marker-icon.png';
import marker2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: marker2x,
    iconUrl: marker,
    shadowUrl: markerShadow
});

// Select2
import select2 from 'select2';
window.select2 = select2;

// Custom scripts
require('./scripts')
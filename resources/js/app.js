require('./bootstrap');

// jQuery
import $ from 'jquery';

// Expose $ and jQuery to window scope
window.$ = window.jQuery = $;

// Flatpickr (datetime picker)
import flatpickr from "flatpickr";

// Custom scripts
require('./scripts')

// Expose Dropzone to window scope
import Dropzone from "dropzone";
window.Dropzone = Dropzone;
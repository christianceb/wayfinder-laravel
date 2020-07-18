require('./bootstrap');

// jQuery
import $ from 'jquery';

// Ghetto way of exposing $ to window scope
window.$ = window.jQuery = $;

// Flatpickr (datetime picker)
import flatpickr from "flatpickr";

// Custom scripts
require('./scripts')
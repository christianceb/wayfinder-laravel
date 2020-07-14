require('./bootstrap');

// jQuery
import $ from 'jquery';

// Ghetto way of exposing $ to window scope
window.$ = window.jQuery = $;

// Custom scripts
require('./scripts')
require('./bootstrap');
import $ from 'jquery';

// Ghetto way of exposing $ to window scope
window.$ = window.jQuery = $;
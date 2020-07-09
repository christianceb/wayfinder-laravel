@extends('layouts.app')

@section('title')
Wayfinder Laravel
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="display-1 text-center">Wayfinder Laravel</h1>

      @guest
        <p class="text-center">Logged out</p>
      @else
        <p class="text-center">Logged in</p>
      @endguest
    </div>
  </div>
</div>
@endsection
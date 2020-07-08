@extends('layouts.app')


@section('content')

<div class="container box">

   @if(isset(Auth::user()->email))
    <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->email }}</strong>
     <br />
     <a href="{{ url('/Admin/login') }}">Logout</a>
    </div>
   @else
   @endif
   
   <br />
</div>

@endsection
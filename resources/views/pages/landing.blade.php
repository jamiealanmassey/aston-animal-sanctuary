@extends('layouts.default')
@section('content')
<div class="card landing-card bg-dark text-white text-center">
    <img class="card-img landing-card-img" src="img/dog-landing.jpg" alt="Dog cover image">
    <div class="card-img-overlay p-3 p-md-5 m-md-3">
        <h5 class="card-title display-4 font-weight-normal">Adopt a Friend</h5>
        <p class="card-text lead font-weight-normal">Our mission statement is to connect animals with loving owners who truly care</p>
        {{-- this should say "Adopt Now" or "Register Now" depending on if the user is logged in --}}
        <a class="btn btn-default" href="{{ url('/adopt') }}"><strong>Adpot Now</strong></a>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col bg-light-2 text-center">
            <h1 class="mt-4"><strong>Super Star Pets</strong></h1>
        </div>
    </div>
    <div class="row">
        @for ($x = 0; $x < 4; $x++)
            <div class="col-lg-3 col-md-6 col-xs-12 bg-light-2 text-center overflow-hidden">
                <div class="mr-md-3 pt-3 pt-md-5 mb-5">
                    <h2 class="display-5">Pet Name #{{ $x+1 }}</h2>
                    <p class="lead">Please adopt this cute animal before they are adopted by someone else! 
                    <p class="lead"><h6><strong>CLICK ON ME TO FIND OUT MORE</strong></h6></p>
                    <a href="#">
                        <img src="img/featured/featured_{{ $x+1 }}.jpg" class="rounded-circle mt-2" width="150px" height="150px">
                    </a>
                </div>
            </div>
        @endfor
    </div>
</div>
@stop
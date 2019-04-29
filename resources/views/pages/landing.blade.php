@extends('layouts.default')
@section('content')
<div class="card landing-card bg-dark text-white rounded-0 border-0 text-center">
    <img class="card-img landing-card-img" src="img/dog-landing.jpg" alt="Dog cover image">
    <div class="card-img-overlay p-3 p-md-5 m-md-3">
        <h5 class="card-title display-4 font-weight-normal">Adopt a Friend</h5>
        <p class="card-text lead font-weight-normal">Our mission statement is to connect animals with loving owners who truly care</p>
        @if (Auth::check())
            <a class="btn btn-default" href="{{ url('/adopt') }}"><strong>Adpot Now</strong></a>
        @else
            <a class="btn btn-default" href="{{ url('/register') }}"><strong>Signup Now</strong></a>
        @endif
    </div>
</div>
<div class="container-fluid landing-content p-3">
    <div class="row landing-content mb-5">
        @foreach ($featured_pets as $featured)
            <div class="col-xs-12 col-md-6 col-xl-3 bg-light-2 text-center secondary-text overflow-hidden">
                <a href="{{ url('/pet/view/' . $featured->id) }}" class="secondary-text">
                    <div class="card p-3 mb-4">
                        <h2 class="display-5">{{ $featured->name }}</h2>
                        <p class="lead">Please adopt this cute animal before they are adopted by someone else!
                        <p class="lead"><h6><strong>CLICK ON ME TO FIND OUT MORE</strong></h6></p>
                        <img src="{{ asset($featured->profile_img) }}" class="rounded-circle mt-2 mb-4 mx-auto" width="150px" height="150px">
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@stop

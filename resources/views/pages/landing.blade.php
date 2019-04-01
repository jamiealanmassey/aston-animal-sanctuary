@extends('layouts.default')
@section('content')
<div class="card landing-card bg-dark text-white text-center">
    <img class="card-img landing-card-img" src="img/dog-landing.jpg" alt="Dog cover image">
    <div class="card-img-overlay p-3 p-md-5 m-md-3">
        <h5 class="card-title display-4 font-weight-normal">Adopt a Friend</h5>
        <p class="card-text lead font-weight-normal">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <a class="btn btn-default" href="{{ url('/adopt') }}">Adpot Now!</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        @for ($x = 0; $x < 4; $x++)
            <div class="col-lg-3 col-md-6 col-xs-12 bg-light-2 text-center overflow-hidden">
                <div class="mr-md-3 pt-3 pt-md-5 mb-5">
                    <h2 class="display-5">Featured Pet #{{ $x+1 }}</h2>
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
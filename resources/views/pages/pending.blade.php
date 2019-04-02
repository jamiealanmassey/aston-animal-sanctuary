@extends('layouts.default')
@section('content')

<div class="container">
    <div class="row text-center">
        <div class="col">
            <h1 class="mt-3 inverse-text"><strong>My Pending Adoption Applications</strong></h6>
        </div>
    </div>
    <div class="row mt-4">
        @for ($x = 0; $x < 2; $x++)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card text-center">
                    <img class="card-img-left" src="img/featured/featured_{{ $x+1 }}.jpg" alt="" width="100%" height="250px">
                    <div class="card-body">
                        <h5 class="card-title pet-name"><strong>Pet Name #{{ $x+1 }} - {{ $x + 3 }} years old</strong></h5>
                        <p>Some bio about the pet that says how cute they are and how you should adopt them!</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger" href="#" role="button">Withdraw Application</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@stop
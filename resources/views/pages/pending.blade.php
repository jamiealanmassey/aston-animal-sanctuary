@extends('layouts.default')
@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col">
            <h1 class="mt-3"><strong>My Pending Adoption Applications</strong></h6>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        @for ($x = 0; $x < 5; $x++)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card text-center secondary-text">
                    <img class="card-img-left" src="img/featured/featured_{{ $x+1 }}.jpg" alt="" width="100%" height="250px">
                    <div class="card-body">
                        <h5 class="card-title pet-name"><strong>Pet Name #{{ $x+1 }} - {{ $x + 3 }} years old</strong></h5>
                        <p>Some bio about the pet that says how cute they are and how you should adopt them!</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger" href="#" role="button" data-toggle="modal" data-target="#withdrawModal">Withdraw Application</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered secondary-text" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to withdraw your application to adopt this pet?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@stop
@extends('layouts.headless')
@section('content')
<div class="container inverse-text">
    <div class="row mt-5">
        <a href="{{ url('/adopt') }}" class="return ml-3">
            <h5>Go Back to Aston Animal Santuary</h5>
        </a>
    </div>
    <div class="row mt-5">
        <div class="col-sm-12 col-md-3">
            <img src="img/0_200.png" class="rounded" width="250px" height="250px">
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="ml-2">
                <h3><strong>John Doe</strong></h3>
                <h6><i class="fas fa-map-marker-alt"></i> Derby, UK</h6>
                <h6><i class="fas fa-birthday-cake"></i> 03.12.1996</h6>
                <div class="mt-3">
                    <h5>Biography</h5>
                    <p><i>This user has no written biography</i></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 text-center">
        <div class="col">
            <h2><strong>Past Adoptions</strong></h2>
            <h4 class="text-muted mt-3">There is nothing to show</h4>
        </div>
    </div>
    <div class="row mt-2 text-center">
        <div class="col-sm-12 col-md-3">
        </div>
        <div class="col-sm-12 col-md-9">
        </div>
    </div>
</div>
@stop
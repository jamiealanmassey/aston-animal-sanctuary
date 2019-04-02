@extends('layouts.minimal')
@section('content')
@if (isset($user))
    <div class="container">
        <div class="row mt-5">
            <a href="{{ url('/adopt') }}" class="return ml-3">
                <h5>Go Back to Aston Animal Santuary</h5>
            </a>
        </div>
        <div class="row mt-5 secondary-text">
            <div class="col-sm-12 col-md-3">
                @if (isset($user->profile_image))
                    <img src="{{ "../profile_image/" . $user->profile_image }}" width="256px" height="256px" class="d-none d-lg-block rounded">
                @else
                    <img src="{{ "../img/0_200.png" }}" class="rounded" width="256px" height="256px">
                @endif
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="ml-2">
                    <h3><strong>{!! $user->first_name . ' ' . $user->last_name !!}</strong></h3>
                    <h6><i class="fas fa-map-marker-alt"></i> {!! isset($user->location) ? $user->location : 'Unknown' !!}</h6>
                    <h6><i class="fas fa-birthday-cake"></i> {!! isset($user->birth_date) ? $user->birth_date : "Unknown" !!}</h6>
                    <div class="mt-3">
                        <h5>Biography</h5>
                        <p>{!! isset($user->bio) ? $user->bio : "<i>No bio exists for this user</i>" !!}</p>
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
@else
    <div class="container mt-5 primary-text text-center">
        <h1><strong>USER NOT FOUND</strong></h1>
        <h5><a class="secondary-text" href="{{ url('/adopt') }}">Take me home</a></h5>
    </div>
@endif
@stop

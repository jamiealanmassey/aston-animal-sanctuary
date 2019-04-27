@extends('layouts.minimal')
@section('content')
@if (isset($user))
    <div class="container">
        <div class="row mt-5">
            <div class="col-9">
            </div>
            <a href="{{ url('/adopt') }}" class="return ml-3">
                <h5><i class="fas fa-arrow-left"></i> Go Back to Aston Animal Santuary</h5>
            </a>
            @if (Auth::user()->id == $user->id)
                <div class="col-3 text-right">
                    <a href="{{ url('/profile/edit') }}" class="return">
                        <h6>Edit Profile</h6>
                    </a>
                </div>
            @endif
        </div>
        <div class="row mt-5 secondary-text">
            <div class="col-sm-12 col-md-3">
                @if (isset($user->profile_image))
                    <img src="{{ asset($user->profile_image) }}" width="256px" height="256px" class="d-none d-lg-block rounded">
                @else
                    <img src="{{ asset('img/0_200.png') }}" class="rounded" width="256px" height="256px">
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
                @if (count($adoptions) == 0)
                    <h2><strong>Past Adoptions</strong></h2>
                    <h4 class="text-muted mt-3">There is nothing to show</h4>
                @else
                    <div class="container-fluid">
                        <h2><strong>Past Adoptions</strong></h2>
                        @foreach ($adoptions as $adoption)
                            <div class="row mb-3 mt-3">
                                <div class="col-12">
                                    <a href="{{ url('pet/view/' . $adoption->id) }}">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title"><b>{{ $adoption->name }}</b></h5>
                                                <p class="card-text">{{ $adoption->description }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
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

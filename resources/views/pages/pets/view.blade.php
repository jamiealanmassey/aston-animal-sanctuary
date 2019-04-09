@extends('layouts.default')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 col-lg-3 mb-4">
            <img src={{ asset(isset($pet->profile_img) ? $pet->profile_img : 'img/0_200.png') }} width="100%" class="rounded">
            <div class="pet-information mt-2">
                <h4 class="text-center"><strong>{!! $pet->name !!}</strong></h4>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                        <th scope="row"></th>
                            <td><i class="fas fa-calendar"></i></td>
                            <td><h5 class="text-muted">{!! $pet->age_years !!} years, {!! $pet->age_months !!} months old</h5></td>
                        </tr>
                        <tr>
                        <th scope="row"></th>
                            <td><i class="fas fa-clock"></i></td>
                            <td><h5 class="text-muted">posted {!! date('d-m-Y', strtotime($pet->created_at)) !!}</h5></td>
                        </tr>
                    </tbody>
                </table>
                @include('fragments.pet.request', [ 'id' => $pet->id ])
                @if (Auth::check() && Auth::user()->admin)
                    <div class="mt-2">
                        <a href="{{ url('pet/edit/' . $pet->id) }}">
                            <button class="btn btn-default btn-block">Edit Pet</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-12 col-lg-9">
            <div class="row">
                {{-- TODO: Add carousel of images --}}
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3><strong><i class="fas fa-paw"></i> More About Me</strong></h3>
                            <i>{!! $pet->description !!}</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="container text-center">

                        <div class="card">
                            <div class="card-body text-left">
                                <h3><strong><i class="fas fa-list"></i> Pending Applicants</strong></h3>
                                <div class="container">
                                    <div class="row mt-3">
                                        @if (isset($applicants) && count($applicants) > 0)
                                            @foreach ($applicants as $applicant)
                                                <div class="col-sm-3 col-md-2 ml-2 mr-2">
                                                    <a href="{{ url('profile/view/' . $applicant->id) }}">
                                                        <img class="rounded" src="{{ asset($applicant->profile_image) }}" width="128px" height="128px">
                                                    </a>
                                                </div>
                                            @endforeach
                                        @else
                                            <h5 class="mt-3">There is no one here <i class="fas fa-heart-broken"></i></h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

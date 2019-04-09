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
                <form method="POST" action="{{ url('/pet/view/request/' . $pet->id) }}">
                    @csrf
                    <button type="button" class="btn btn-success btn-block">Request Adoption</button>
                </form>
                @if (Auth::check() && Auth::user()->admin)
                    <div class="mt-2">
                        <a href="">
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
                    @if (isset($pending))

                    @else
                        <h1>No Pending Adoptions</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                            @php
                                $animal_type = Config::get('animaltypes')[$pet->type];
                                $animal_breeds = Config::get('animalbreeds')[$animal_type];
                                $animal_breed = $animal_breeds[$pet->breed];
                            @endphp
                            <th scope="row"></th>
                            <td><i class="fas fa-dna"></i></td>
                            <td><h5 class="text-muted">{!! $animal_breed !!}</h5></td>
                        </tr>
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
                    <div class="mt-2">
                        <a href="#">
                            <div data-toggle="modal" data-target="#modal" class="btn btn-danger btn-block">
                                Delete Pet
                            </div>
                        </a>
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-label">WARNING</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this pet?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ url('/pet/delete/' . $pet->id) }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">Delete Pet</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-12 col-lg-9">
            <div class="row">
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
            @php
                $already_adopted = DB::table('pet_user')
                    ->where('pet_id', '=', $pet->id)
                    ->where('adoption_status', '=', 2)
                    ->get();
            @endphp
            @if (($already_adopted != null && count($already_adopted) == 0) || $already_adopted == null)
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
            @endif
        </div>
    </div>
</div>
@endsection

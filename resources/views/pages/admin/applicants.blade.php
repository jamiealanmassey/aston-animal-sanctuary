@extends('layouts.default')
@section('content')
@if (isset($requests) && count($requests) > 0)
<div class="container mt-5">
    <div class="row">
        @foreach ($requests as $request)
            @php
                $user = \App\User::find($request->user_id);
                $pet = \App\Pet::find($request->pet_id);
            @endphp
            <div class="col-md-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ url('/profile/view/' . $user->id) }}" target="_blank">
                            <img class="img-overflow rounded mr-2" src="{{ asset($user->profile_image) }}" height="128px" width="128px">
                        </a>
                        <a href="{{ url('/pet/view/' . $pet->id) }}" target="_blank">
                            <img class="img-overflow rounded ml-2" src="{{ asset($pet->profile_img) }}" height="128px" width="128px">
                        </a>
                        <div class="container mt-3">
                            <h4><strong><span class="emphasize">{!! $user->first_name . ' ' . $user->last_name !!}</span> wants <span class="emphasize">{!! $pet->name !!}</span></strong></h4>
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-6 text-right border-right">
                                        <h5>More about {!! $user->first_name !!}</h5>
                                        <p><i>{!! isset($user->bio) ? '"' . $user->bio . '"' : "No bio set" !!}</i></p>
                                    </div>
                                    <div class="col-6 text-left border-left">
                                        <h5>More about {!! $pet->name !!}</h5>
                                        <p><i>"{!! $pet->description !!}"</i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid mt-3">
                                <a href="#">
                                    <div class="btn btn-success mr-1">Accept Applicant</div>
                                </a>
                                <a href="#">
                                    <div class="btn btn-danger ml-1">Reject Applicant</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer secondary-text text-center">
                        <h6><strong class="text-muted"><i>Request made {!! $request->created_at !!}</i></strong></h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@elseif (isset($requests) && count($requests) == 0)
    <h1 class="text-center mt-5"><strong>Invalid search query</strong></h1>
@else
    <h1 class="text-center mt-5"><strong>There are currently no Applicants</strong></h1>
@endif
@endsection

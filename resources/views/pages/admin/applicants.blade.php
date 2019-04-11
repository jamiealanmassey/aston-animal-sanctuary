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
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <a href="{{ url('/profile/view/' . $user->id) }}">
                            <img class="img-overflow rounded shadow mr-3" src="{{ asset($user->profile_image) }}" height="128px" width="128px">
                        </a>
                        <a href="{{ url('/pet/view/' . $pet->id) }}">
                            <img class="img-overflow rounded shadow ml-3" src="{{ asset($pet->profile_img) }}" height="128px" width="128px">
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
                                <form method="POST" action="{{ url('/applicants/accept/' . $user->id . '?pet_id=' . $pet->id) }}" class="mb-2">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="btn btn-success btn-block">Accept Applicant</button>
                                </form>
                                <form method="POST" action="{{ url('/applicants/reject/' . $user->id . '?pet_id=' . $pet->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="btn btn-danger btn-block">Reject Applicant</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@elseif (isset($requests) && count($requests) == 0)
    <h1 class="text-center mt-5"><strong>There are currently no Applicants</strong></h1>
@else
    <h1 class="text-center mt-5"><strong>Invalid search query</strong></h1>
@endif
@endsection

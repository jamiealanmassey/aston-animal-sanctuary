@extends('layouts.default')
@section('content')
<div class="container mt-4">
    @foreach ($requests as $request)
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @php
                                $user = \App\User::find($request->user_id);
                                $pet = \App\Pet::find($request->pet_id);
                            @endphp
                            <img class="img-overflow rounded mr-3" src="{{ asset($pet->profile_img) }}" height="128px" width="128px">
                            <i class="fas fa-grin-hearts"></i>
                            <img class="img-overflow rounded-circle ml-3" src="{{ asset($user->profile_image) }}" height="128px" width="128px">
                            {{-- Image of pet with loveheart to right --}}
                            {{-- Image of user profile to adopt --}}
                            {{-- Name of user + application + info --}}
                            {{-- Buttons to approve or reject --}}
                        </div>
                    </div>
                </div>
                <div class="card-footer secondary-text text-center">
                    {{-- add date + time when request was made --}}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

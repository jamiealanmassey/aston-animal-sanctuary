@extends('layouts.default')
@section('content')
<div class="container mt-4">
        @if (isset($applications) && count($applications) > 0)
            <div class="row">
            @foreach ($applications as $application)
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                    <div class="card mx-auto">
                        <div class="card-body mx-auto">
                            <div class="container-fluid mx-auto">
                                @php
                                    $pet = \App\Pet::find($application->pet_id);
                                @endphp
                                <div class="row mx-auto">
                                    <a href="{{ url('pet/view/' . $pet->id) }}">
                                        <img class="img-overflow mx-auto rounded" src="{{ asset($pet->profile_img) }}" height="128px" width="128px">
                                    </a>
                                </div>
                                <div class="row mt-3">
                                    @if ($application->adoption_status == 0)
                                        <h6 class="mx-auto shadow-sm p-1 text-warning"><strong>Application Pending</strong></h6>
                                    @elseif ($application->adoption_status == 1)
                                        <h6 class="mx-auto shadow-sm text-danger"><strong>Application Rejected</strong></h6>
                                    @elseif ($application->adoption_status == 2)
                                        <h6 class="mx-auto shadow-sm text-success"><strong>Application Accepted</strong></h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <div class="jumbotron d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <h4 class="mx-auto"><strong>You have no applications being processed</strong></h4>
                    </div>
                    <div class="row mt-2">
                        <a class="mx-auto" href="{{ url('/adopt') }}">
                            <div class="btn btn-lg btn-info">Adopt a Pet</div>
                        </a>
                    </div>
                </div>
            </div>
        @endif
</div>
@endsection

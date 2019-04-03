@extends('layouts.default')
@section('content')
<div class="container mt-5 secondary-text">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    {{ __('Add New Pet') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/pet/new') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="pet-type" class="col-md-4 col-form-label text-md-right">{{ __('Pet Type') }}</label>

                            <div class="col-md-6">
                                <select id="pet-type" class="form-control{{ $errors->has('pet_type') ? ' is-invalid' : '' }} custom-select" name="pet_type" value="{{ old('pet_type') }}" required
                                    onchange="window.location.href = '/pet/new?pet_type=' + $(this).children('option:selected').val()">
                                    @foreach ($animal_types as $type)
                                        @if ($loop->index == Request::get('pet_type', 1)-1)
                                            {!! "<option value=" . ($loop->index+1) . " selected>" . $type . "</option>" !!}
                                        @else
                                            {!! "<option value=" . ($loop->index+1) . ">" . $type . "</option>" !!}
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('pet_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pet_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pet-breed" class="col-md-4 col-form-label text-md-right">{{ __('Pet Type') }}</label>

                            <div class="col-md-6">
                                <select id="pet-breed" class="form-control{{ $errors->has('pet_breed') ? ' is-invalid' : '' }} custom-select" name="pet_breed" value="{{ old('pet_breed') }}" required>
                                    @foreach ($animal_breeds[$animal_types[Request::get('pet_type', 1)-1]] as $breed)
                                        @if ($loop->first)
                                            {!! "<option value=" . ($loop->index+1) . " selected>" . $breed . "</option>" !!}
                                        @else
                                            {!! "<option value=" . ($loop->index+1) . ">" . $breed . "</option>" !!}
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('pet_breed'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pet_breed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pet-name" class="col-md-4 col-form-label text-md-right">{{ __('Pet Name') }}</label>

                            <div class="col-md-6">
                                <input id="pet-name" type="text" class="form-control{{ $errors->has('pet_name') ? ' is-invalid' : '' }}" name="pet_name" value="{{ old('pet_name') }}" required autofocus>

                                @if ($errors->has('pet_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pet_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pet-age-years" class="col-md-4 col-form-label text-md-right">{{ __('Age Years') }}</label>

                            <div class="col-md-6">
                                <input id="pet-age-years" type="number" min="0" max="25" class="form-control{{ $errors->has('pet_age_years') ? ' is-invalid' : '' }}" name="pet_age_years" value="{{ old('pet_age_years') }}" required autofocus>

                                @if ($errors->has('pet_age_years'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pet_age_years') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pet-age-months" class="col-md-4 col-form-label text-md-right">{{ __('Age Months') }}</label>

                            <div class="col-md-6">
                                <input id="pet-age-months" type="number" min="0" max="12" class="form-control{{ $errors->has('pet_age_months') ? ' is-invalid' : '' }}" name="pet_age_months" value="{{ old('pet_age_months') }}" required autofocus>

                                @if ($errors->has('pet_age_months'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pet_age_months') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pet-description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="pet-description" class="form-control{{ $errors->has('pet_description') ? ' is-invalid' : '' }}" name="pet_description" value="{{ old('pet_description') }}" required></textarea>
                                <small>
                                    This field allows minimal forms of HTML
                                </small>

                                @if ($errors->has('pet_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pet_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="profile-image" class="col-md-4 col-form-label text-md-right">{{ __('Upload Pictures') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile_image" aria-describedby="inputGroupFileAddon01" onchange="$('#visual-file-label').html($(this).val().replace(/.*[\/\\]/, ''));">
                                        <label id="visual-file-label" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <small id="uploadHelpBlock" class="form-text text-muted">
                                   All images must be < 2MB.
                                </small>

                                @if ($errors->has('profile_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Adoption Page') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

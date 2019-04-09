@extends('layouts.minimal')
@section('content')
<div class="container secondary-text mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User Profile') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('profile/edit') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group row">
                            <label for="first-name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first-name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $user->first_name }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $user->last_name }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birth-date" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth-date" type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" value="{{ $user->birth_date }}" required>

                                @if ($errors->has('birth_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ $user->location }}" required>

                                @if ($errors->has('location'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="biography" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>

                            <div class="col-md-6">
                                <textarea id="biography" class="form-control{{ $errors->has('biography') ? ' is-invalid' : '' }}" name="biography" value="{{ $user->bio }}">{!! $user->bio !!}</textarea>

                                @if ($errors->has('biography'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('biography') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ url('/profile/view') }}">
                                    <div class="btn btn-danger">Cancel</div>
                                </a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

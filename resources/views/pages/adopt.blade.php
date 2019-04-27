@extends('layouts.default')
@section('content')
@php
    $filter_types = [
        'Dog',
        'Cat',
        'Rabbit'
    ];

    $filter_options = [
        'Most Relevant',
        'Alphabetical (Ascending)',
        'Alphabetical (Descending)',
        'Date Added (Ascending)',
        'Date Added (Descending)',
    ];
@endphp
<div class="container mt-5 mb-5 secondary-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-12 mb-4">
                <form method="GET" action="{{ url('/adopt') }}">
                    <b>Sort By</b>
                    <select class="form-control form-control-sm mb-2 mt-1" name="filters-sort">
                        @for ($i = 0; $i < count($filter_options); $i++)
                            <option value="{{ $i }}" {!! $i == $filter_sort ? 'selected' : '' !!}>{!! $filter_options[$i] !!}</option>
                        @endfor
                    </select>
                    <b>Animal Type</b>
                    <select class="form-control form-control-sm mb-2 mt-1" name="filters-type">
                        @for ($i = 0; $i < count($filter_types); $i++)
                            <option value="{{ $i }}" {!! $i == $filter_type ? 'selected' : '' !!}>{!! $filter_types[$i] !!}</option>
                        @endfor
                    </select>
                    <button class="btn btn-block btn-primary btn-sm mt-3" type="submit">Update Filters</button>
                </form>
            </div>
            <div class="col-lg-10 col-md-12">
                <div class="container">
                    <div class="row">
                        @foreach ($pets as $pet)
                        @include('fragments.pet.frame', [ 'pet' => $pet ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@extends('layouts.default')
@section('content')
<div class="container secondary-text mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-12 mb-4">
                <p><b>Sort By</b></p>
                <select class="form-control form-control-sm mb-2">
                    <option value="1"selected>Most Relevant</option>
                    <option value="2">Alphabetical (Ascending)</option>
                    <option value="3">Alphabetical (Descending)</option>
                    <option value="4">Date Added (Ascending)</option>
                    <option value="5">Date Added (Descending)</option>
                </select>
                <p><b>Animal Type</b></p>
                <select class="form-control form-control-sm mb-2">
                    <option value="1" selected>Dog</option>
                    <option value="2">Cat</option>
                    <option value="3">Bird</option>
                    <option value="4">Bunny</option>
                    <option value="5">Hamster</option>
                </select>
                <p><b>Animal Breeds</b></p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="breed-checkbox-1">
                    <label class="form-check-label" for="breed-checkbox-1">
                        Border Collie
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="breed-checkbox-2">
                    <label class="form-check-label" for="breed-checkbox-2">
                        Deutschund
                    </label>
                </div>
            </div>
            <div class="col-lg-10 col-md-12">
                <div class="container">
                    <div class="row">
                        @for ($x = 0; $x < 12; $x++)
                        <div class="col-lg-4 col-md-6 col-xs-12 mb-4">
                            <a href="#">
                                <div class="card">
                                    <img src="https://carepharmaceuticals.com.au/wp-content/uploads/sites/19/2018/02/placeholder-600x400.png" class="card-img-top" alt="...">
                                    <div class="card-body primary-text">
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
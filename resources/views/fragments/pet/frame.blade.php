<div class="col-lg-4 col-md-6 col-xs-12 mb-4">
    <a href="{{ url('pet/view/' . $pet->id) }}">
        <div class="card secondary-text">
            <div class="card-img-top">
                <img src="{{ $pet->profile_img }}" alt="image of {{ $pet->name }}" />
            </div>
            <div class="card-body secondary-text">
                @php
                    $animal_type = Config::get('animaltypes')[$pet->type];
                    $animal_breeds = Config::get('animalbreeds')[$animal_type];
                    $animal_breed = $animal_breeds[$pet->breed];
                @endphp
                <h4 class="text-center"><strong>{!! $pet->name !!}</strong></h4>
                <p class="card-text">{!! $pet->description !!}</p>
            </div>
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item text-muted">{!! $animal_breed !!}</li>
            </ul>
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item text-muted">{!! 'posted ' . date('d-m-Y', strtotime($pet->created_at)) !!}</li>
            </ul>
            <div class="card-footer secondary-text text-center">
                @include('fragments.pet.request', [ 'id' => $pet->id, 'user' => Auth::user() ])
                <a class="btn btn-info btn-block text-white mt-2" href="{{ url('pet/view/' . $pet->id) }}">Read More</a>
            </div>
        </div>
    </a>
</div>

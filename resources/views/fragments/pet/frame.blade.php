<div class="col-lg-4 col-md-6 col-xs-12 mb-4">
    <a href="{{ url('pet/view/' . $pet->id) }}">
        <div class="card secondary-text">
            <img src="{{ $pet->profile_img }}"  width="100%" height="100%" alt="...">
            <div class="card-body secondary-text">
                <h4 class="text-center"><strong>{!! $pet->name !!}</strong></h4>
                <p class="card-text">{!! $pet->description !!}</p>
            </div>
            <ul class="list-group list-group-flush text-center">
                <li class="list-group-item text-muted">{!! 'posted ' . date('d-m-Y', strtotime($pet->created_at)) !!}</li>
            </ul>
            <div class="card-footer secondary-text text-center">
                @include('fragments.pet.request', [ 'id' => $pet->id, 'user' => Auth::user() ])
                <a class="btn btn-info btn-block mt-2" href="{{ url('pet/view/' . $pet->id) }}">Read More</a>
            </div>
        </div>
    </a>
</div>

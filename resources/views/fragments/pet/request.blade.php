@if (Auth::check() && Auth::user()->admin)
    <a href="{{ url('applicants/view?pet_id=' . $id) }}">
        <div class="btn btn-warning btn-block">View Applicants</div>
    </a>
@else
    @php
    if (Auth::check())
    {
        $adoptions = Auth::user()->pets;
        $contains = false;
        foreach ($adoptions as $adoption)
        {
            if ($adoption->id == $id)
                $contains = true;
        }
    }
    @endphp
    @if (isset($contains) && $contains)
        <form method="POST" action="{{ url('/pet/view/cancel/' . $id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger btn-block">Cancel Request</button>
        </form>
    @else
        <form method="POST" action="{{ url('/pet/view/request/' . $id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-success btn-block">Request Adoption</button>
        </form>
    @endif
@endif

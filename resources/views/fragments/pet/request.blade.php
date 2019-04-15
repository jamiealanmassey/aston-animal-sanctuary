@if (Auth::check() && Auth::user()->admin)
    <a href="{{ url('applicants/view?pet_id=' . $id) }}">
        <div class="btn btn-warning btn-block">View Applicants</div>
    </a>
@else
    @php
    if (Auth::check())
    {
        $already_adopted = DB::table('pet_user')
            ->where('pet_id', '=', $id)
            ->where('adoption_status', '=', 2)
            ->get();

        $requested = DB::table('pet_user')
            ->where('pet_id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();
    }
    @endphp
    @if (isset($requested) && $requested)
        @if ($requested->adoption_status == 0)
            <form method="POST" action="{{ url('/pet/view/cancel/' . $id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-block">Cancel Request</button>
            </form>
        @elseif ($requested->adoption_status == 1)
            <div class="btn btn-danger btn-block disabled">Adoption Rejected</div>
        @elseif ($requested->adoption_status == 2)
            <div class="btn btn-success btn-block disabled">Adoption Approved</div>
        @endif
    @elseif (isset($requested) && !$requested)
        @if (count($already_adopted) == 0)
            <form method="POST" action="{{ url('/pet/view/request/' . $id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-success btn-block">Request Adoption</button>
            </form>
        @else
            <div class="btn btn-secondary btn-block disabled">Already Adopted</div>
        @endif
    @else
        <form method="POST" action="{{ url('/pet/view/request/' . $id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-success btn-block">Request Adoption</button>
        </form>
    @endif
@endif

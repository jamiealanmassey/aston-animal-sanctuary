<form method="POST" action="{{ url('/pet/view/request/' . $id) }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="button" class="btn btn-success btn-block">Request Adoption</button>
</form>

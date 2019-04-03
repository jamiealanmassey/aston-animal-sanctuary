<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><b class="primary-text">Aston Animal Santuary</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item nav-item-select {{ Request::is('adopt*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('adopt') }}">Adpot a Pet {!! Request::is('adopt*') ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                @if (Auth::check() && Auth::user()->admin > 0)
                    <li class="nav-item nav-item-select {{ Request::is('applicants*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('applicants') }}">View Applicants {!! Request::is('applicants*') ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                    </li>
                    <li class="nav-item nav-item-select {{ Request::is('pet*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('pet/new/') }}">Add New Pet {!! Request::is('pet*') ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                    </li>
                @elseif (Auth::check())
                    <li class="nav-item nav-item-select {{ Request::is('pending*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('pending') }}">Pending Applications {!! Request::is('pending*') ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                    </li>
                @endif
            </ul>
            <div class="navbar-nav ml-auto mt-2 mt-lg-0">
                @if (Auth::check())
                    <div class="dropdown show mr-2">
                        <a class="btn dropdown-toggle primary-text" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {!! Auth::user()->first_name . ' ' . Auth::user()->last_name !!}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item primary-text" href="{{ url('profile') }}">Profile</a>
                            <a class="dropdown-item primary-text" href="{{ url('privacy') }}">Privacy Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item primary-text" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                Logout
                            </a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    @if (isset(Auth::user()->profile_image))
                        <img src="{{ asset('profile_image/' . Auth::user()->profile_image) }}" width="40px" class="d-none d-lg-block rounded">
                    @else
                        <img src="{{ asset('img/0_200.png') }}" width="40px" class="d-none d-lg-block rounded">
                    @endif
                @else
                    <li class="nav-item nav-item-select {{ Request::is('login*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('login') }}">Login {!! Request::is('login*') ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                    </li>
                    <li class="nav-item nav-item-select {{ Request::is('register*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('register') }}">Register {!! Request::is('register*') ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                    </li>
                @endif
            </div>
        </div>
    </div>
</nav>

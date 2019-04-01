<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><b class="primary-text">Aston Animal Santuary</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item nav-item-select {{ Request::is('adopt*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('adopt') }}">Adpot a Pet <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item nav-item-select {{ Request::is('pending*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('pending') }}">Pending Applications</a>
                </li>
            </ul>
            <div class="navbar-nav ml-auto mt-2 mt-lg-0">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('profile') }}">John Doe</a>
                    </li>
                </ul>
                <img src="img/0_200.png" width="40px" class="d-none d-lg-block"/>
            </div>
        </div>
    </div>
</nav>
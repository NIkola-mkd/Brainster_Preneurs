<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light border-navbar bg-white-custom ">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="/dashboard">
                <h1 class="navbar-responsive"> <span class="black-custom semi-bold">Brainster</span><span class="gray-custom semi-bold">Preneurs</span> </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @if(Auth::user()->image != null)
                <ul class="navbar-nav ms-auto font-1rem">
                    <li class="nav-item ">
                        <a class="nav-link navbar-responsive {{ Request::is('projects/my-projects') ? 'active' : '' }}" aria-current="page" href="/projects/my-projects">My projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-responsive " href="/applications/my-applications">My appclications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-responsive {{ Request::is('profile/my-profile') ? 'active' : '' }}" href="/profile/my-profile">My profile</a>
                    </li>
                </ul>
                @endif
                @if(Auth::user()->image == null)
                <a class="nav-link d-grid gap-2 d-md-flex justify-content-md-end" href="/profile/my-profile"><img class="avatar" src="{{ asset('avatars/default_avatar.png') }}" alt="..."></a>
                @else
                <div class="btn-group dropstart d-lg-block d-none">
                    <a class="nav-link " href="/profile/my-profile" data-bs-toggle="dropdown" aria-expanded="false"><img class="avatar dropdown-toggle" src="{{ asset('avatars/' . Auth::user()->image) }}" alt="..."></a>
                    <ul class="dropdown-menu mt-5">
                        <li class="dropdown-item ">{{Auth::user()->email}}</li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/profile/my-profile">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <li class="d-lg-none d-block"><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endif
            </div>
        </div>
    </nav>
</header>
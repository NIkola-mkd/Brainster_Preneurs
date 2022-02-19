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
                        <a class="nav-link navbar-responsive " href="#">My appclications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-responsive {{ Request::is('profile/my-profile') ? 'active' : '' }}" href="/profile/my-profile">My profile</a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
                @endif
                @if(Auth::user()->image == null)
                <a class="nav-link d-grid gap-2 d-md-flex justify-content-md-end" href="/profile/my-profile"><img class="avatar" src="{{ asset('avatars/default_avatar.png') }}" alt="..."></a>
                @else
                <a class="nav-link " href="/profile/my-profile"><img class="avatar" src="{{ asset('avatars/' . Auth::user()->image) }}" alt="..."></a>
                @endif
            </div>
        </div>
    </nav>
</header>
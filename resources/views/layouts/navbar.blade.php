<header>
    <nav class="navbar navbar-expand-lg navbar-light border-navbar">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="#">
                <h1> <span class="black-custom semi-bold">Brainster</span><span class="gray-custom semi-bold">Preneurs</span> </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto font-1rem">
                    <li class="nav-item ">
                        <a class="nav-link  " aria-current="page" href="#">My projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">My appclications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ Request::is('profile/my-profile') ? 'active' : '' }}" href="/profile/my-profile">My profile</a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
                @if(Auth::user()->image == null)
                <a class="nav-link " href=""><img class="avatar" src="{{ asset('avatars/default_avatar.png') }}" alt="..."></a>
                @endif
            </div>
        </div>
    </nav>
</header>
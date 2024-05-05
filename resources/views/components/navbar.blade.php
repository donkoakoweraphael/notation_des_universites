<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <div style="height: 52px; width: 52px; border-radius: 26px; padding:1px" class="bg-light">
                <img style="height: 50px; width: 50px; border-radius: 25px;"
                src="@if ($authUser->image_path) {{ asset('storage/'.$authUser->image_path) }} @else {{ asset('storage/'.$authUser::$default_image_path) }} @endif"
                     alt="">
            </div>
        </a>
        <a class="navbar-brand">
            @if ($authUser->is_admin)
                Administrateur
            @endif
            <strong>
                {{ $authUser->last_name }} {{ $authUser->first_name }}
            </strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link"></a>
                </li>
            </ul>

            @if ($authUser->is_admin)
                <a class="d-flex me-2 btn @section('admin-page-active') btn-outline-secondary @show"  href="{{ route('admin.dashboard') }}">Administration</a>
            @endif
            <a class="d-flex me-2 btn @section('university-page-active') btn-outline-secondary @show" href="{{ route('user.home') }}">Universités</a>
            <a class="d-flex me-2 btn @section('profile-page-active') btn-outline-secondary @show" href="{{ route('user.profile') }}">Profil</a>
            <form class="d-flex" action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
            </form>
        </div>
    </div>
</nav>

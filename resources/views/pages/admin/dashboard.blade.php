<p>
    Bienvenu @if (Auth::user()->is_admin)
        Admin
    @endif {{ Auth::user() }}
</p>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Se déconnecter</button>
</form>

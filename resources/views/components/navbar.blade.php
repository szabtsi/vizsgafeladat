<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('home') }}">Bejegyzések</a>
                @auth    
                    <a class="nav-link" href="{{ route('post.create') }}">Új bejegyzés</a>
                    <a class="nav-link" href="{{ route('myposts', auth()->user()->id) }}">Bejegyzéseim</a>
                    <form action="{{ route('user.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Kijelentkezés</button>
                    </form>
                @endauth
                @guest    
                    <a class="nav-link" href="{{ route('login.show') }}">Belépés</a>
                    <a class="nav-link" href="{{ route('register.create') }}">Regisztráció</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
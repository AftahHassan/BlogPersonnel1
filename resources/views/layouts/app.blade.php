<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'BlogPersonnel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">
                📝 BlogPersonnel
            </a>
            <ul class="navbar-menu">
                <li><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                <li><a href="{{ route('articles.index') }}" class="nav-link">Articles</a></li>

                @auth
                    <li><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-logout">Déconnexion</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li><a href="{{ route('login') }}" class="btn-login">Connexion</a></li>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- CONTENU PRINCIPAL -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} BlogPersonnel. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tableau de Bord') - Admin AllSports</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles globaux -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Styles spécifiques à la page -->
    @stack('styles')
</head>
<body>
    <!-- En-tête -->
    <header class="admin-header">
        <div class="header-content">
            <div class="logo-section">
                <a href="{{ route('admin.dashboard') }}" class="logo">AllSports</a>
                <span class="admin-badge">Admin</span>
            </div>

            <div class="header-actions">
                <a href="{{ url('/') }}" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Voir le site
                </a>

                <div class="admin-info dropdown">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->nom ?? 'A', 0, 1)) }}
                    </div>
                    <div class="admin-details">
                        <span class="admin-name">
                        @if (Auth::check())
                        {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                    @else
                        Administrateur
                    @endif
                    </span>
                        <span class="admin-email">{{ auth()->user()->email ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="main-content">
        <div class="container">

            <!-- === Messages Flash (Session) === -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="close">&times;</button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible">
                    <i class="fas fa-exclamation-circle"></i> {{ session('warning') }}
                    <button type="button" class="close">&times;</button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible">
                    <i class="fas fa-info-circle"></i> {{ session('info') }}
                    <button type="button" class="close">&times;</button>
                </div>
            @endif

            <!-- === Erreurs de validation (Bag $errors) === -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <i class="fas fa-times-circle"></i> <strong>Erreurs de validation :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close">&times;</button>
                </div>
            @endif

            <!-- === Conflit : Utilisateur non admin === -->
            @if(auth()->check() && auth()->user()->type_user !== 'admin')
                <div class="alert alert-danger alert-dismissible">
                    <i class="fas fa-ban"></i> <strong>Accès refusé</strong> : Vous n'avez pas les droits d'administrateur.
                    <button type="button" class="close">&times;</button>
                </div>
                @php redirect()->to('/')->send(); @endphp
            @endif

            <!-- === Contenu dynamique === -->
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    @stack('scripts')

    <!-- Script pour fermer les alertes -->
    <script>
        document.querySelectorAll('.alert .close').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.parentElement.style.opacity = '0';
                setTimeout(() => btn.parentElement.remove(), 300);
            });
        });

        // Auto-fermeture après 5 secondes
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                if (!alert.querySelector('.close')) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    </script>
</body>
</html>

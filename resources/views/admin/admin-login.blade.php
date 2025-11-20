<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - AllSports</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="logo">AllSports</div>
        <span class="badge">Admin</span>
        <p class="welcome">Bon retour, cher administrateur !</p>

        <!-- === Messages d'erreur === -->
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- === Formulaire de connexion === -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="mot_de_passe"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn">Se connecter</button>
        </form>

        <div class="footer-link">
            <a href="{{ url('/') }}">Retour au site</a>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Connexion Client</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #004d99;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }
        .navbar .logo img {
            height: 40px;
            width: auto;
        }
        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-bottom: 50px;
            max-width: 600px;
            width: 100%;
        }
        h2 {
            color: #004d99;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
        /* Bouton vert */
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .alert-danger {
            border-radius: 8px;
            font-size: 0.95rem;
            padding: 15px;
        }
        .input-group-text {
            background-color: #e9ecef;
            border-right: none;
            border-radius: 8px 0 0 8px;
        }
        .input-group > .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 0.85rem;
            margin-top: auto;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .text-center.mt-3 a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .text-center.mt-3 a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Titre -->
            <a class="navbar-brand" href="#">SNEL</a>

            <!-- Bouton menu mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-pencil-square me-1"></i> S'inscrire
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-info-circle me-1"></i> À propos
                        </a>
                    </li>
                    <li class="nav-item ms-3 logo">
                        <img src="{{ asset('images/snel.jpg') }}" alt="Logo SNEL">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content - Form -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="form-container">
            <h2>
                <i class="bi bi-person-circle me-2"></i> Connexion Client
            </h2>

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulaire de connexion --}}
            <form action="{{ route('handleClientLogin') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Votre adresse e-mail" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 SNEL. Tous droits réservés.</p>
            <p>
                <a href="#">Contact</a> |
                <a href="#">Mentions Légales</a> |
                <a href="#">Politique de Confidentialité</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

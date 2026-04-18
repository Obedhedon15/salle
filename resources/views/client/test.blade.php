<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Connexion Client</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Intégration de Bootstrap Icons pour les icônes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Custom styles for a professional look */
        body {
            font-family: 'Inter', sans-serif; /* Using Inter font as per instructions */
            background-color: #f0f2f5; /* Light grey background */
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure full viewport height */
        }
        .navbar {
            background-color: #004d99; /* Dark blue SNEL color */
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
        }
        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
            margin-top: 50px;
            margin-bottom: 50px;
            max-width: 600px; /* Max width for the form card */
            width: 100%;
        }
        h2 {
            color: #004d99; /* SNEL blue for headings */
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            border-radius: 8px; /* Rounded corners for inputs */
            padding: 12px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #007bff; /* Highlight on focus */
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            background-color: #007bff; /* Bootstrap blue for primary button */
            border-color: #007bff;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            width: 100%; /* Full width button */
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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
            background-color: #343a40; /* Dark grey footer */
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 0.85rem;
            margin-top: auto; /* Push footer to the bottom */
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
            <a class="navbar-brand" href="#">SNEL - Connexion Client</a>
        </div>
    </nav>

    <!-- Main Content - Form -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="form-container">
            <h2>Connexion Client</h2>

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

                <div class="text-center mt-3">
                    <p>Pas encore de compte ? <a href="#">S'inscrire ici</a></p>
                </div>
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

    <!-- Intégration de Bootstrap JS (bundle incluant Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Modifier le Client</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Intégration de Bootstrap Icons pour les icônes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Custom styles for a professional look */
        body {
            font-family: 'Inter', sans-serif; /* Using Inter font */
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
        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            width: 100%;
            margin-top: 15px;
        }
        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SNEL - Modifier le Client</a>
        </div>
    </nav>

    <!-- Main Content - Form -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="form-container">
            <h2>Modifier le Client</h2>

            {{-- Message de succès --}}
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

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

            {{-- Formulaire de modification --}}
            <form action="{{ route('client.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Utiliser la méthode PUT pour la mise à jour --}}

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $client->nom) }}" placeholder="Votre nom" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="postnom" class="form-label">Postnom :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="postnom" id="postnom" class="form-control" value="{{ old('postnom', $client->postnom) }}" placeholder="Votre postnom (facultatif)">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $client->prenom) }}" placeholder="Votre prénom" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse', $client->adresse) }}" placeholder="Votre adresse complète" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $client->telephone) }}" placeholder="Votre numéro de téléphone (facultatif)">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="numcompteur" class="form-label">Numéro de compteur :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-hash"></i></span>
                        <input type="text" name="numcompteur" id="numcompteur" class="form-control" value="{{ old('numcompteur', $client->numcompteur) }}" placeholder="Votre numéro de compteur SNEL" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email) }}" placeholder="Votre adresse e-mail" required>
                    </div>
                </div>

                {{-- Les champs de mot de passe ne sont pas toujours nécessaires pour la modification --}}
                {{-- Si vous voulez permettre la modification du mot de passe, vous pouvez les inclure --}}
                {{-- et ajouter une logique côté Laravel pour gérer leur validation conditionnelle. --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe (laisser vide si inchangé) :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Entrez un nouveau mot de passe">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez le nouveau mot de passe">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>

                <a href="{{ route('clients.index') }}" class="btn btn-secondary-custom">Retour à la liste</a>
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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL Congo - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        .header {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header .nav-links a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }
        
        .header .logo img {
            height: 40px;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: calc(100% - 100px);
            text-align: center;
        }

        .main-content .center-logo img {
            width: 500px;
            height: auto;
            max-width: 80%;
        }

        .main-content .buttons {
            margin-top: 50px;
        }

        .main-content .buttons .btn {
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            font-weight: bold;
        }

        .main-content .buttons .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .main-content .buttons .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        
        .main-content .buttons .btn-secondary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            color: white;
        }
        
        .main-content .buttons .btn-secondary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
        }
        
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="nav-links">
            <a href="/loginAgent">Connexion Agent</a>
            <a href="/loginAdmin">Connexion Admin</a>
            <a href="#">À propos</a>
        </div>
        <div class="logo">
        <img src="{{ asset('images/snel.jpg') }}" alt="Logo SNEL">
        </div>
    </div>

    <div class="main-content">
        <div class="center-logo">
        <img src="{{ asset('images/snel.jpg') }}" alt="Logo SNEL">
        </div>
        <div class="buttons">
            <a href="/loginClient" class="btn btn-primary me-3">Se connecter</a>
            <a href="#" class="btn btn-secondary">S'inscrire</a>
        </div>
    </div>

    <div class="footer">
        © 2025 SNEL Congo - Tous droits réservés.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
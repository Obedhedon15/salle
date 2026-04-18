<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SNEL Congo - Espace Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #002d6b;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .user-info {
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .header .user-info img {
            height: 40px;
            margin-right: 15px;
        }

        .header .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: bold;
        }

        .main-content {
            flex-grow: 1;
            padding: 50px 20px;
            display: flex;
            justify-content: center;
        }

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            max-width: 1000px;
        }

        .action-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 12px 15px; /* Réduit le padding vertical et horizontal */
            text-align: center;
            width: 200px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 160px; /* Réduit la hauteur minimale des cartes */
        }

        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .action-card .icon {
            font-size: 2rem; /* Taille de l'icône réduite */
            color: #007bff;
            margin-bottom: 8px; /* Marge réduite */
        }

        .action-card h3 {
            font-size: 1rem; /* Taille du titre réduite */
            font-weight: bold;
            margin-bottom: 4px; /* Marge réduite */
            line-height: 1.2;
        }

        .action-card p {
            font-size: 0.8rem; /* Taille du texte réduite */
            color: #6c757d;
            margin: 0; /* Supprime la marge pour compacter */
            flex-grow: 1;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="user-info">
        <img src="{{ asset('images/snel.jpg') }}" alt="Logo SNEL">
            <span>Mon espace client</span>
        </div>
        <div class="nav-links">
            <a href="#">Accueil</a>
            <a href="#">Mes Factures</a>
            <a href="#">Archives</a>
            <a href="/">Deconnexion</a>
        </div>
    </div>

    <div class="main-content">
        <div class="card-container">
            <a href="/listeFacturesClient" class="action-card">
                <div class="icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h3>Mes Factures</h3>
                <p>Voir et télécharger vos factures.</p>
            </a>

            <a href="/paiements/liste" class="action-card">
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>Paiement</h3>
                <p>Payer vos factures en ligne.</p>
            </a>

            <a href="#" class="action-card">
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3>Historique</h3>
                <p>Consulter vos paiements passés.</p>
            </a>

            <a href="#" class="action-card">
                <div class="icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h3>Profil</h3>
                <p>Gérer vos informations personnelles.</p>
            </a>
        </div>
    </div>

    <div class="footer">
        © 2025 SNEL Congo - Tous droits réservés.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
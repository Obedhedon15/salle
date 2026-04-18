<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Archivage Numérique des Factures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #004d99; /* Bleu foncé SNEL */
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
        }
        .hero-section {
            background-color: #e9ecef;
            padding: 80px 0;
            text-align: center;
            color: #004d99;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .hero-section p {
            font-size: 1.5rem;
            max-width: 800px;
            margin: 0 auto 40px;
            color: #555;
        }
        .btn-custom {
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin: 0 10px;
        }
        .btn-client {
            background-color: #007bff; /* Bleu Bootstrap */
            color: #fff;
            border: none;
        }
        .btn-client:hover {
            background-color: #0056b3;
        }
        .btn-agent {
            background-color: #6c757d; /* Gris foncé Bootstrap */
            color: #fff;
            border: none;
        }
        .btn-agent:hover {
            background-color: #5a6268;
        }
        .btn-admin {
            background-color: #343a40; /* Noir/gris très foncé Bootstrap */
            color: #fff;
            border: none;
        }
        .btn-admin:hover {
            background-color: #23272b;
        }
        .section-padding {
            padding: 60px 0;
        }
        .about-section, .advantages-section {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
        }
        .about-section h2, .advantages-section h2 {
            color: #004d99;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
        }
        .advantage-item {
            text-align: center;
            margin-bottom: 30px;
        }
        .advantage-item i {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 15px;
        }
        .advantage-item h4 {
            color: #004d99;
            font-weight: 600;
            margin-bottom: 10px;
        }
        footer {
            background-color: #343a40; /* Gris très foncé */
            color: #fff;
            padding: 30px 0;
            text-align: center;
            font-size: 0.9rem;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SNEL - Archivage Numérique</a>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1>Simplifiez la gestion de vos factures SNEL</h1>
            <p>Accédez, archivez et gérez vos factures d'électricité en toute sécurité et avec une facilité inégalée.</p>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-custom btn-client">Connexion Client</a>
                <a href="#" class="btn btn-custom btn-agent">Connexion Agent</a>
                <a href="#" class="btn btn-custom btn-admin">Connexion Administrateur</a>
            </div>
        </div>
    </header>

    <section class="section-padding about-section">
        <div class="container">
            <h2 class="mb-5">À Propos de l'Application</h2>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <p class="lead text-center">
                        L'application d'archivage numérique des factures de la SNEL est une plateforme innovante conçue pour moderniser la consultation et la gestion de vos factures d'électricité. Dites adieu aux documents papier et bonjour à une solution digitale intuitive, sécurisée et accessible à tout moment, depuis n'importe quel appareil.
                    </p>
                    <p class="text-center">
                        Notre objectif est de vous offrir une expérience utilisateur fluide, tout en garantissant l'intégrité et la confidentialité de vos données. Que vous soyez un client souhaitant consulter ses historiques de consommation, un agent SNEL gérant les dossiers, ou un administrateur supervisant le système, l'application est pensée pour vous.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding advantages-section">
        <div class="container">
            <h2 class="mb-5">Avantages Clés</h2>
            <div class="row">
                <div class="col-md-4 advantage-item">
                    <i class="bi bi-shield-lock"></i> <h4>Sécurité Renforcée</h4>
                    <p>Vos factures et informations personnelles sont protégées par des protocoles de sécurité avancés et un cryptage des données.</p>
                </div>
                <div class="col-md-4 advantage-item">
                    <i class="bi bi-globe"></i>
                    <h4>Accessibilité Optimale</h4>
                    <p>Accédez à vos factures 24h/24 et 7j/7, depuis votre ordinateur, tablette ou smartphone, où que vous soyez.</p>
                </div>
                <div class="col-md-4 advantage-item">
                    <i class="bi bi-clock-history"></i>
                    <h4>Gain de Temps</h4>
                    <p>Recherchez, consultez et téléchargez vos factures instantanément, sans effort ni perte de temps.</p>
                </div>
                <div class="col-md-4 advantage-item">
                    <i class="bi bi-leaf"></i>
                    <h4>Écologique et Moderne</h4>
                    <p>Participez à la réduction de l'empreinte carbone en optant pour une gestion des factures entièrement numérique.</p>
                </div>
                <div class="col-md-4 advantage-item">
                    <i class="bi bi-graph-up"></i>
                    <h4>Historique Complet</h4>
                    <p>Visualisez un historique détaillé de vos consommations et paiements pour une meilleure gestion budgétaire.</p>
                </div>
                <div class="col-md-4 advantage-item">
                    <i class="bi bi-lightning-charge"></i>
                    <h4>Simplicité d'Utilisation</h4>
                    <p>Une interface utilisateur intuitive et conviviale, conçue pour tous les profils d'utilisateurs.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025 SNEL. Tous droits réservés.</p>
            <p>
                <a href="#">Contact</a> |
                <a href="#">Mentions Légales</a> |
                <a href="#">Politique de Confidentialité</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
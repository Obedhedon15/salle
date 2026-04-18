<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Mon Espace Client</title>
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
        .navbar-brand, .nav-item .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .container-main {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-bottom: 50px;
            width: 100%;
        }
        h2 {
            color: #004d99;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
        }
        .table thead {
            background-color: #004d99;
            color: #fff;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 12px 15px;
            border-color: #e9ecef;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }
        .btn-custom {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
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
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link">Bienvenue, {{ Auth::user()->prenom ?? 'Client' }} !</span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container d-flex justify-content-center align-items-start flex-grow-1">
    <div class="container-main">
        <h2>Mes Factures</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Date d'émission</th>
                        <th>Montant HT</th>
                        <th>TVA</th>
                        <th>Montant TTC</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($factures as $facture)
                        <tr>
                            <td>{{ $facture->numero_facture }}</td>
                            <td>{{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</td>
                            <td>{{ number_format($facture->montant_ht, 2) }} CDF</td>
                            <td>{{ number_format($facture->tva, 2) }} CDF</td>
                            <td>{{ number_format($facture->montant_ttc, 2) }} CDF</td>
                            <td>
                                @if ($facture->statut_paiement == 'payé')
                                    <span class="badge bg-success">Payé</span>
                                @elseif ($facture->statut_paiement == 'en attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @else
                                    <span class="badge bg-danger">Impayé</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    @if ($facture->fichier_pdf)
                                        <a href="{{ asset('storage/' . $facture->fichier_pdf) }}" target="_blank" class="btn btn-info btn-sm btn-custom">
                                            <i class="bi bi-file-earmark-pdf-fill"></i> Voir PDF
                                        </a>
                                    @endif

                                    @if ($facture->statut_paiement != 'payé')
                                        <a href="{{ route('formulaire.ajouter', ['facture_id' => $facture->id]) }}" class="btn btn-success btn-sm btn-custom">
                                            <i class="bi bi-credit-card"></i> Payer
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Aucune facture trouvée pour votre compte.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

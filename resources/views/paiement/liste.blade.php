<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Liste des Paiements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --snel-blue: #002d6b;
            --snel-yellow: #f1c40f;
            --snel-green: #2ecc71;
            --snel-red: #e74c3c;
            --snel-gray: #f0f2f5;
        }

        body {
            background-color: var(--snel-gray);
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: var(--snel-blue);
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
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: var(--snel-blue);
            color: white;
            border-bottom: 2px solid var(--snel-yellow);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-header h4 {
            font-weight: bold;
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .table thead th {
            background-color: var(--snel-blue);
            color: white;
            font-weight: bold;
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: #f9fbfd;
        }

        .table-striped > tbody > tr:hover {
            background-color: #e9ecef;
        }

        .badge-status {
            font-size: 0.9em;
            padding: 0.5em 0.8em;
            border-radius: 50px;
            font-weight: bold;
        }
        .badge-success { background-color: var(--snel-green); color: white; }
        .badge-warning { background-color: var(--snel-yellow); color: #212529; }
        .badge-danger { background-color: var(--snel-red); color: white; }
        
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
            <span>Bienvenue</span>
        </div>
        
    </div>

    <div class="container main-content">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h4 class="mb-0 d-flex align-items-center">
                    <i class="fas fa-list me-2"></i> Historique des Paiements
                </h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Facture</th>
                                <th>Référence</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paiements as $paiement)
                                <tr>
                                    <td>{{ $paiement->id }}</td>
                                    <td>{{ $paiement->client->nom }}</td>
                                    <td>{{ $paiement->facture->numero_facture }}</td>
                                    <td>{{ $paiement->reference }}</td>
                                    <td>{{ number_format($paiement->montant, 2, ',', ' ') }} CDF</td>
                                    <td>
                                        @if($paiement->status == 'Paye')
                                            <span class="badge badge-status badge-success">Payé</span>
                                        @elseif($paiement->status == 'en attente')
                                            <span class="badge badge-status badge-warning">En attente</span>
                                        @else
                                            <span class="badge badge-status badge-danger">Échec</span>
                                        @endif
                                    </td>
                                    <td>{{ $paiement->date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-info-circle me-2"></i>Aucun paiement trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        © 2025 SNEL Congo - Tous droits réservés.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
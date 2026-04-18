<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Mon Espace Agent</title>
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
        .nav-item .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .nav-item .nav-link:hover {
            color: rgba(255, 255, 255, 0.75) !important;
        }
        .container-main {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
            margin-top: 50px;
            margin-bottom: 50px;
            width: 100%;
        }
        h2 {
            color: #004d99; /* SNEL blue for headings */
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }
        .table {
            border-radius: 10px; /* Rounded corners for the table */
            overflow: hidden; /* Ensures rounded corners apply to content */
        }
        .table thead {
            background-color: #004d99; /* Dark blue for table header */
            color: #fff;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 12px 15px;
            border-color: #e9ecef; /* Lighter border for cells */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Lighter stripe color */
        }
        .btn-custom {
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px; /* Space between icon and text */
        }
        .btn-success {
            background-color: #28a745; /* Green for add */
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-warning {
            background-color: #ffc107; /* Yellow for edit */
            border-color: #ffc107;
            color: #333; /* Darker text for contrast */
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545; /* Red for delete */
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-info {
            background-color: #17a2b8; /* Info blue for view PDF */
            border-color: #17a2b8;
            color: #fff;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
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
        .badge {
            padding: 0.5em 0.8em;
            font-size: 0.8em;
            font-weight: 600;
            border-radius: 0.375rem;
        }
        /* Custom modal styles */
        .custom-modal-header {
            background-color: #dc3545;
            color: white;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
        }
        .custom-modal-footer {
            border-top: none;
            justify-content: center;
            padding-bottom: 20px;
        }
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        .search-bar {
            margin-bottom: 25px;
        }
        .search-bar .input-group-text {
            border-radius: 8px 0 0 8px;
        }
        .search-bar .form-control {
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SNEL - Mon Espace Agent</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        {{-- Assuming Auth::user() is available and contains agent data --}}
                        <span class="nav-link">Bienvenue, {{ Auth::user()->nom ?? 'Agent' }} !</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white-50">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content - Facture List for Agent -->
    <div class="container d-flex justify-content-center align-items-start flex-grow-1">
        <div class="container-main">
            <h2 class="mb-4">Gestion des Factures</h2>

            {{-- Message de succès --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                {{-- Bouton d'ajout --}}
                <a href="{{ route('facture.ajouter') }}" class="btn btn-success btn-custom me-3">
                    <i class="bi bi-plus-circle-fill"></i> Ajouter une facture
                </a>

                {{-- Barre de recherche --}}
                <form action="{{ route('welcome.agent') }}" method="GET" class="search-bar d-flex flex-grow-1">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par numéro, client, statut..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>

            {{-- Table des factures --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Numéro</th>
                            <th>Date d'émission</th>
                            <th>Montant HT</th>
                            <th>TVA</th>
                            <th>Montant TTC</th>
                            
                            <th>Client</th>
                            <th>Agent</th>
                            <th>Fichier PDF</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Assurez-vous que la variable $factures est passée à cette vue depuis votre contrôleur --}}
                        @forelse ($factures as $facture)
                            <tr>
                                <td>{{ $facture->id }}</td>
                                <td>{{ $facture->numero_facture }}</td>
                                <td>{{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</td>
                                <td>{{ number_format($facture->montant_ht, 2) }} $</td>
                                <td>{{ number_format($facture->tva, 2) }} $</td>
                                <td>{{ number_format($facture->montant_ttc, 2) }} $</td>
                               
                                <td>{{ $facture->client->nom ?? 'N/A' }} {{ $facture->client->prenom ?? '' }}</td>
                                <td>{{ $facture->agent->nom ?? 'N/A' }}</td>
                                <td>
                                    @if ($facture->fichier_pdf)
                                        <a href="{{ asset('storage/' . $facture->fichier_pdf) }}" target="_blank" class="btn btn-info btn-sm btn-custom">
                                            <i class="bi bi-file-earmark-pdf-fill"></i> Voir PDF
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    {{-- Modifier --}}
                                    <a href="{{ route('facture.update', $facture->id) }}" class="btn btn-warning btn-sm btn-custom me-2">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>

                                    {{-- Supprimer (avec modale personnalisée) --}}
                                    <button type="button" class="btn btn-danger btn-sm btn-custom" data-bs-toggle="modal" data-bs-target="#deleteFactureModal" data-facture-id="{{ $facture->id }}">
                                        <i class="bi bi-trash-fill"></i> Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-4">Aucune facture trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div class="modal fade" id="deleteFactureModal" tabindex="-1" aria-labelledby="deleteFactureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="deleteFactureModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    Êtes-vous sûr de vouloir supprimer cette facture ? Cette action est irréversible.
                </div>
                <div class="modal-footer custom-modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form id="deleteForm" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
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
    <script>
        // JavaScript pour gérer la modale de suppression
        document.addEventListener('DOMContentLoaded', function() {
            var deleteFactureModal = document.getElementById('deleteFactureModal');
            deleteFactureModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                var factureId = button.getAttribute('data-facture-id');
                // Update the modal's content.
                var deleteForm = deleteFactureModal.querySelector('#deleteForm');
                // Set the action URL for the form
                // Assuming your route for deletion is something like /factures/{id}
                deleteForm.action = `/factures/${factureId}`; // Adjust this URL based on your Laravel route
            });
        });
    </script>
</body>
</html>

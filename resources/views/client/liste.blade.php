<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEL - Gestion des Clients</title>
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SNEL - Gestion des Clients</a>
        </div>
    </nav>

    <!-- Main Content - Client List -->
    <div class="container d-flex justify-content-center align-items-start flex-grow-1">
        <div class="container-main">
            <h2 class="mb-4">Liste des Clients</h2>

            {{-- Message de succès --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Bouton d'ajout --}}
            <a href="{{ route('client.register') }}" class="btn btn-success btn-custom mb-3">
                <i class="bi bi-person-plus-fill"></i> Ajouter un client
            </a>

            {{-- Table des clients --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Postnom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Num compteur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->postnom }}</td>
                                <td>{{ $client->prenom }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->telephone }}</td>
                                <td>{{ $client->adresse }}</td>
                                <td>{{ $client->numcompteur }}</td>
                                <td>
                                    {{-- Modifier --}}
                                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning btn-sm btn-custom me-2">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>

                                    {{-- Supprimer (avec modale personnalisée) --}}
                                    <button type="button" class="btn btn-danger btn-sm btn-custom" data-bs-toggle="modal" data-bs-target="#deleteClientModal" data-client-id="{{ $client->id }}">
                                        <i class="bi bi-trash-fill"></i> Supprimer
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">Aucun client trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="deleteClientModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    Êtes-vous sûr de vouloir supprimer ce client ? Cette action est irréversible.
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
            var deleteClientModal = document.getElementById('deleteClientModal');
            deleteClientModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                var clientId = button.getAttribute('data-client-id');
                // Update the modal's content.
                var deleteForm = deleteClientModal.querySelector('#deleteForm');
                // Set the action URL for the form
                // Assuming your route for deletion is something like /clients/{id}
                deleteForm.action = `/clients/${clientId}`; // Adjust this URL based on your Laravel route
            });
        });
    </script>
</body>
</html>

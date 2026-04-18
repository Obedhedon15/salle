<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement en ligne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-5 rounded-4" style="max-width: 600px; width: 100%;">
            <h2 class="text-center mb-4 text-primary">💳 Paiement en ligne</h2>

            <form method="POST" action="{{ route('paiements.handleAjouter') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" value="{{ $client->prenom }} {{ $client->nom }}" class="form-control form-control-lg rounded-3" required readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $client->email }}" class="form-control form-control-lg rounded-3" required readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" value="{{ $client->telephone }}" class="form-control form-control-lg rounded-3" required readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Numéro de la facture</label>
                    <input type="text" class="form-control form-control-lg rounded-3" value="Facture #{{ $facture->numero_facture }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Montant TTC</label>
                    <input type="text" class="form-control form-control-lg rounded-3" value="{{ number_format($facture->montant_ttc, 2, ',', ' ') }} CDF" disabled>
                </div>

                <!-- Champ caché pour envoyer l'ID de la facture -->
                <input type="hidden" name="facture_id" value="{{ $facture->id }}">

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill">
                        ✅ Payer maintenant
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optionnel si pas d'interaction JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

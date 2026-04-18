<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une facture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg rounded-4 p-4">
            <h2 class="mb-4 text-center text-primary">🧾 Ajouter une nouvelle facture</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('handleFactureAjouter') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Numéro de facture</label>
                        <input type="text" name="numero_facture" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date d’émission</label>
                        <input type="date" name="date_emission" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Montant HT</label>
                        <input type="number" step="0.01" name="montant_ht" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">TVA (%)</label>
                        <input type="number" step="0.01" name="tva" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Montant TTC</label>
                        <input type="number" step="0.01" name="montant_ttc" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Statut du paiement</label>
                    <select name="statut_paiement" class="form-select" required>
                        <option value="en attente">En attente</option>
                        <option value="payé">Payé</option>
                        <option value="impayé">Impayé</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fichier PDF de la facture</label>
                    <input type="file" name="fichier_pdf" class="form-control" accept="application/pdf" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-select" required>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->prenom }} {{ $client->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Agent</label>
                        <select name="agent_id" class="form-select" required>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">💾 Enregistrer la facture</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

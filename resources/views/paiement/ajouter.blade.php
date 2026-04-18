<h1>Paiement en ligne</h1>

<form method="POST" action="{{ route('paiements.handleAjouter') }}">
    @csrf
    <label>Nom complet</label>
    <input type="text" name="name" required><br>

    <label>Email</label>
    <input type="email" name="email" required><br>

    <label>Téléphone</label>
    <input type="text" name="phone" required><br>

    <label>Facture</label>
<select name="facture_id" required>
    @foreach ($factures as $facture)
        <option value="{{ $facture->id }}">
            Facture #{{ $facture->numero_facture }} - {{ number_format($facture->montant_ttc, 2, ',', ' ') }} CDF
        </option>
    @endforeach
</select>

    <button type="submit">Payer maintenant</button>
</form>
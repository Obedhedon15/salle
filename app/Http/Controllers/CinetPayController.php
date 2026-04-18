<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Paiement;

class CinetPayController extends Controller
{
    /**
     * Lance le paiement via CinetPay.
     */
    public function payer(Request $request)
    {
        $paiement_id = session('paiement_id');

        if (!$paiement_id) {
            return redirect()->route('paiements.index')->withErrors('Aucun paiement en cours.');
        }

        $paiement = Paiement::find($paiement_id);

        if (!$paiement) {
            return redirect()->route('paiements.index')->withErrors('Paiement introuvable.');
        }

        if ($paiement->statut === 'payé') {
            return redirect()->route('paiements.index')->withErrors('Ce paiement a déjà été effectué.');
        }

        // Préparer les données pour CinetPay
        $payload = [
            'apikey' => env('CINETPAY_API_KEY'),
            'site_id' => env('CINETPAY_SITE_ID'),
            'transaction_id' => $paiement->reference,
            'amount' => $paiement->montant,
            'currency' => 'XAF',
            'description' => "Paiement frais scolaire - Élève ID: {$paiement->client_id}",
            'return_url' => route('paiement.retour'),
            'notify_url' => route('paiement.notification'),
            'customer_name' => $paiement->nom_client,
            'customer_email' => $paiement->email ?? 'default@email.com',
            'customer_phone_number' => $paiement->telephone,
            'customer_country' => 'CM',
        ];

        // Désactivation de la vérification SSL
        $response = Http::withOptions(['verify' => false])->post('https://api-checkout.cinetpay.com/v2/payment', $payload);

        $data = $response->json();

        if (isset($data['code']) && $data['code'] === '201') {
            // Nettoyer la session
            $request->session()->forget('paiement_id');

            return redirect($data['data']['payment_url']);
        }

        return redirect()->route('paiements.index')->withErrors('Erreur lors de la création du paiement CinetPay.');
    }

    /**
     * Retour utilisateur après paiement (GET ou POST).
     */
    public function retour(Request $request)
    {
        $reference = $request->input('transaction_id');

        if (!$reference) {
            return redirect()->route('paiements.index')->withErrors('Aucune transaction fournie.');
        }

        // Désactivation de la vérification SSL
        $response = Http::withOptions(['verify' => false])->post('https://api-checkout.cinetpay.com/v2/payment/check', [
            'apikey' => env('CINETPAY_API_KEY'),
            'site_id' => env('CINETPAY_SITE_ID'),
            'transaction_id' => $reference,
        ]);

        $data = $response->json();

        if (isset($data['data']['status']) && $data['data']['status'] === 'ACCEPTED') {
            Paiement::where('reference', $reference)->update([
                'statut' => 'payé',
                'date_paiement' => now(),
            ]);

            return redirect()->route('paiements.index')->with('success', 'Paiement effectué avec succès.');
        }

        return redirect()->route('paiements.index')->withErrors('Paiement non confirmé ou échoué.');
    }

    /**
     * Liste des paiements (interface admin ou parent).
     */
    public function liste()
    {
        $paiements = Paiement::latest()->get();
        return view('paiements.index', compact('paiements'));
    }

    /**
     * Notification serveur (IPN / webhook CinetPay).
     */
    public function notification(Request $request)
    {
        $reference = $request->input('transaction_id');

        if (!$reference) {
            return response('Aucune transaction_id', 400);
        }

        // Désactivation de la vérification SSL
        $response = Http::withOptions(['verify' => false])->post('https://api-checkout.cinetpay.com/v2/payment/check', [
            'apikey' => env('CINETPAY_API_KEY'),
            'site_id' => env('CINETPAY_SITE_ID'),
            'transaction_id' => $reference,
        ]);

        $data = $response->json();

        if (isset($data['data']['status']) && $data['data']['status'] === 'ACCEPTED') {
            Paiement::where('reference', $reference)->update([
                'statut' => 'payé',
                'date_paiement' => now(),
            ]);
        } else {
            Paiement::where('reference', $reference)->update([
                'statut' => 'échoué',
            ]);
        }

        return response('Notification traitée', 200);
    }
}

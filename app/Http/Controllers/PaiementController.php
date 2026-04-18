<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Agent;
use App\Models\Facture;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function handleAjouter(Request $request)
{
    $request->validate([
        'facture_id' => 'required|exists:factures,id',
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
    ]);

    $facture = Facture::findOrFail($request->facture_id);
    $reference = 'REF-' . strtoupper(Str::random(10));

    $paiement = Paiement::create([
        'client_id' => $facture->client_id,
        'facture_id' => $facture->id,
        'reference' => $reference,
        'montant' => $facture->montant_ttc,
        'status' => 'Pending',
        'date' => now(),
    ]);

    $response = Http::timeout(30)
    ->withOptions(['verify' => false])
    ->post('https://api-checkout.cinetpay.com/v2/payment', [

        'apikey' => env('CINETPAY_API_KEY'),
        'site_id' => env('CINETPAY_SITE_ID'),
        'transaction_id' => $reference,
        'amount' => $facture->montant_ttc,
        'currency' => 'CDF',
        'description' => 'Paiement facture n°' . $facture->id,
        'return_url' => env('CINETPAY_RETURN_URL'),
        'notify_url' => env('CINETPAY_NOTIFY_URL'),
        'customer_name' => $request->name,
        'customer_email' => $request->email,
        'customer_phone_number' => $request->phone,
        'customer_country' => 'CD',
    ]);

    $data = $response->json();

    dd($data);
    
    if (isset($data['code']) && $data['code'] == '201') {
        return redirect()->away($data['data']['payment_url']);
    }

    return back()->with('error', 'Erreur CinetPay : ' . ($data['message'] ?? ''));
}

public function ajouter()
{
   $client_id = session('client_id'); // ou récupérer le client connecté
    $factures = Facture::all();

    return view('paiement.ajouter', compact('factures'));
}

public function formulaire(Request $request)
{
 $client = Auth::guard('client')->user();

    if (!$client) {
        return redirect()->route('client.login')->with('error', 'Veuillez vous connecter.');
    }

    $facture = Facture::findOrFail($request->facture_id);

    return view('paiement.formulaire', compact('client', 'facture'));
}


// Nouvelle fonction pour afficher la liste des paiements d'un client
public function liste()
{
    // Récupérer le client connecté
    $client = Auth::guard('client')->user();

    // Vérifier si le client est connecté
    if (!$client) {
        return redirect()->route('client.login')->with('error', 'Veuillez vous connecter.');
    }

    // Récupérer les paiements du client, triés par date de manière descendante
    $paiements = Paiement::where('client_id', $client->id)
                         ->with('facture') // Charge la facture liée pour l'affichage
                         ->orderBy('date', 'desc')
                         ->get();

    // Retourner la vue 'paiement.liste' avec les données des paiements
    return view('paiement.liste', compact('paiements'));
}

}

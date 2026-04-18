<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Client;
use App\Models\Agent;
use Illuminate\Support\Facades\Storage;

class FactureController extends Controller
{
    /**
     * Affiche le formulaire d'ajout de facture
     */
    public function ajouterFacture()
    {
        $clients = Client::all();
        $agents = Agent::all();
        return view('facture.ajouter', compact('clients', 'agents'));
    }

    /**
     * Traite l'enregistrement d'une nouvelle facture
     */
    public function handleAjouterFacture(Request $request)
    {
        $request->validate([
            'numero_facture'   => 'required|unique:factures,numero_facture',
            'date_emission'    => 'required|date',
            'montant_ht'       => 'required|numeric',
            'tva'              => 'required|numeric',
            'montant_ttc'      => 'required|numeric',
            'statut_paiement'  => 'required|in:payé,en attente,impayé',
            'fichier_pdf'      => 'required|mimes:pdf|max:2048',
            'client_id'        => 'required|exists:clients,id',
            'agent_id'         => 'required|exists:agents,id',
        ]);

        // Enregistrement du fichier
        $path = $request->file('fichier_pdf')->store('factures_pdfs', 'public');

        // Création de la facture
        Facture::create([
            'numero_facture'  => $request->numero_facture,
            'date_emission'   => $request->date_emission,
            'montant_ht'      => $request->montant_ht,
            'tva'             => $request->tva,
            'montant_ttc'     => $request->montant_ttc,
            'statut_paiement' => $request->statut_paiement,
            'fichier_pdf'     => $path,
            'client_id'       => $request->client_id,
            'agent_id'        => $request->agent_id,
        ]);

        return redirect()->route('facture.liste')->with('success', 'Facture ajoutée avec succès.');
    }

    /**
     * Affiche la liste des factures
     */
    
     
     public function listeFactures()
    {
        $factures = Facture::with(['client', 'agent'])->get();
        return view('facture.liste', compact('factures'));
    }

    public function listeFacturesClient()
    {
        $factures = Facture::with(['client', 'agent'])->get();
        return view('facture.listeClient', compact('factures'));
    }

    /**
     * Affiche le formulaire de modification d'une facture
     */
    public function edit($id)
    {
        $facture = Facture::findOrFail($id);
        $clients = Client::all();
        $agents = Agent::all();
        return view('factures.editFacture', compact('facture', 'clients', 'agents'));
    }

    /**
     * Met à jour une facture
     */
    public function update(Request $request, $id)
    {
        $facture = Facture::findOrFail($id);

        $request->validate([
            'date_emission'    => 'required|date',
            'montant_ht'       => 'required|numeric',
            'tva'              => 'required|numeric',
            'montant_ttc'      => 'required|numeric',
            'statut_paiement'  => 'required|in:payé,en attente,impayé',
            'fichier_pdf'      => 'nullable|mimes:pdf|max:2048',
            'client_id'        => 'required|exists:clients,id',
            'agent_id'         => 'required|exists:agents,id',
        ]);

        // Si un nouveau fichier est uploadé
        if ($request->hasFile('fichier_pdf')) {
            // Supprimer l'ancien fichier
            if ($facture->fichier_pdf) {
                Storage::disk('public')->delete($facture->fichier_pdf);
            }

            // Sauvegarder le nouveau
            $path = $request->file('fichier_pdf')->store('factures_pdfs', 'public');
            $facture->fichier_pdf = $path;
        }

        // Mise à jour
        $facture->update([
            'date_emission'   => $request->date_emission,
            'montant_ht'      => $request->montant_ht,
            'tva'             => $request->tva,
            'montant_ttc'     => $request->montant_ttc,
            'statut_paiement' => $request->statut_paiement,
            'client_id'       => $request->client_id,
            'agent_id'        => $request->agent_id,
        ]);

        return redirect()->route('facture.liste')->with('success', 'Facture mise à jour.');
    }

    /**
     * Supprime une facture
     */
    public function destroy($id)
    {
        $facture = Facture::findOrFail($id);

        if ($facture->fichier_pdf) {
            Storage::disk('public')->delete($facture->fichier_pdf);
        }

        $facture->delete();

        return redirect()->route('facture.liste')->with('success', 'Facture supprimée.');
    }
}

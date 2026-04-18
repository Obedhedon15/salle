<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture')->unique();
            $table->date('date_emission');
            $table->decimal('montant_ht', 15, 2);
            $table->decimal('tva', 8, 2);
            $table->decimal('montant_ttc', 15, 2);
            $table->string('statut_paiement'); // Exemple : 'payé', 'en attente', 'impayé'
            $table->string('fichier_pdf');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('agent_id');
            // Contraintes de clés étrangères (si tu utilises InnoDB)
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};

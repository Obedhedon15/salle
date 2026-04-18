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
        Schema::create('paiements', function (Blueprint $table) {
           $table->id();
    $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
    $table->foreignId('facture_id')->constrained('factures')->onDelete('cascade');
    $table->string('reference')->unique(); // Référence CinetPay
    $table->decimal('montant', 10, 2);
    $table->string('status')->default('Paye'); // en attente, succès, échec
    $table->date('date'); // Date de paiement
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};

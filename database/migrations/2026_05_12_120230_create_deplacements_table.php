<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deplacements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('lieu');
            $table->string('adresse')->nullable();
            $table->string('client')->nullable();
            $table->string('contact_nom')->nullable();
            $table->string('contact_telephone')->nullable();
            $table->decimal('frais_transport', 10, 2)->default(0);
            $table->decimal('frais_hebergement', 10, 2)->default(0);
            $table->decimal('frais_repas', 10, 2)->default(0);
            $table->decimal('frais_total', 10, 2)->default(0);
            $table->enum('vehicule', ['personnel', 'societe'])->default('personnel');
            $table->enum('statut', ['pending', 'approved', 'refused'])->default('pending');
            $table->text('motif')->nullable();
            $table->text('commentaire_manager')->nullable();
            $table->foreignId('valide_par')->nullable()->constrained('users');
            $table->string('justificatif')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deplacements');
    }
};

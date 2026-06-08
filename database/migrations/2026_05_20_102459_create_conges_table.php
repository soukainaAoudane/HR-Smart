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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');

            $table->enum('statut', ['pending', 'approved', 'refused'])->default('pending');
            $table->text('motif')->nullable();
            $table->text('commentaire_manager')->nullable();
            $table->foreignId('valide_par')->nullable()->constrained('users');
            $table->date('date_validation')->nullable();
            $table->string('justificatif')->nullable();
            $table->enum('type', ['paye', 'rtt', 'sans_solde', 'formation'])->default('paye');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
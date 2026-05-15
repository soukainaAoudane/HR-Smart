<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('mois');
            $table->integer('annee');
            $table->decimal('taux_completion', 5, 2)->default(0);
            $table->decimal('respect_delais', 5, 2)->default(0);
            $table->decimal('score_global', 5, 2)->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'mois', 'annee']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};

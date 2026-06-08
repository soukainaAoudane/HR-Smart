<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('remplacements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conge_id')->constrained()->onDelete('cascade');
            $table->foreignId('remplacant_id')->constrained('users')->onDelete('cascade');
            $table->decimal('score_matching', 5, 2)->default(0);
            $table->enum('statut', ['proposed', 'accepted', 'refused'])->default('proposed');
            $table->foreignId('propose_par')->constrained('users');
            $table->datetime('date_reponse')->nullable();
            $table->timestamps();

            $table->unique(['conge_id', 'remplacant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remplacements');
    }
};
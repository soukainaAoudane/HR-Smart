<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('assignee_a')->constrained('users')->onDelete('cascade');
            $table->foreignId('cree_par')->constrained('users');
            $table->foreignId('projet_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('competence_id')->nullable()->constrained();
            $table->integer('duree_estimee')->default(1);
            $table->date('deadline');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['todo', 'doing', 'done'])->default('todo');
            $table->integer('temps_reel_passe')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};

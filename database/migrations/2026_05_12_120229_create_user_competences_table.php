<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_competences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('competence_id')->constrained()->onDelete('cascade');
            $table->integer('niveau')->default(1);
            $table->boolean('validee')->default(false);
            $table->foreignId('validee_par')->nullable()->constrained('users');
            $table->boolean('auto_detectee')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_competences');
    }
};

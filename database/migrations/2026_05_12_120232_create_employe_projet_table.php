<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employe_projet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employe_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('projet_id')->constrained()->onDelete('cascade');
            $table->string('role_dans_projet')->nullable();
            $table->integer('heures_prevues')->default(0);
            $table->integer('heures_reelles')->default(0);
            $table->timestamps();

            $table->unique(['employe_id', 'projet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employe_projet');
    }
};

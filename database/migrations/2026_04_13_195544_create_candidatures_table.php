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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            $table->foreignId('profil_id')->constrained()->onDelete('cascade');
            $table->text('message'); // Lettre de motivation
            $table->enum('statut', ['en attente', 'acceptee', 'refusee'])->default('en attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};

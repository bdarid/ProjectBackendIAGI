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
        Schema::create('profil_competence', function (Blueprint $table) {
            $table->id();

            // Liaison avec la table profils (clé étrangère)
            $table->foreignId('profil_id')->constrained('profils')->onDelete('cascade');

            // Liaison avec la table competences (clé étrangère)
            $table->foreignId('competence_id')->constrained('competences')->onDelete('cascade');

            // Le niveau de la compétence (ex: Débutant, Intermédiaire, Expert)
            $table->string('niveau')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_competence');
    }
};

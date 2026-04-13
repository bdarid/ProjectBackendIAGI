<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offre;
use App\Models\Profil;
use App\Models\Competence;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create(['role' => 'admin']);

        User::factory(5)->create(['role' => 'recruteur'])->each(function ($user) {
            Offre::factory(rand(2, 3))->create(['user_id' => $user->id]);
        });

        User::factory(10)->create(['role' => 'candidat'])->each(function ($user) {
            $profil = Profil::factory()->create(['user_id' => $user->id]);

        });

        $competences = ['PHP', 'Laravel', 'JavaScript', 'SQL'];
        foreach ($competences as $nom) {
            Competence::create(['nom' => $nom, 'categorie' => 'Informatique']);
        }
    }
}

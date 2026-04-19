<?php

namespace App\Listeners;
use App\Events\CandidatureDeposee;
use Illuminate\Support\Facades\Log;

class LogCandidatureDeposee {
    public function handle(CandidatureDeposee $event) {
        $candidatNom = $event->candidature->profil->user->name;
        $offreTitre = $event->candidature->offre->titre;

        Log::build(['driver' => 'single', 'path' => storage_path('logs/candidatures.log')])
            ->info("Date: " . now() . " | Candidat: $candidatNom | Offre: $offreTitre"); 
    }
}

<?php

namespace App\Listeners;
use App\Events\StatutCandidatureMis;
use Illuminate\Support\Facades\Log;

class LogChangementStatut {
    public function handle(StatutCandidatureMis $event) {
        Log::build(['driver' => 'single', 'path' => storage_path('logs/candidatures.log')])
            ->info("Date: " . now() . " | Ancien Statut: {$event->ancienStatut} | Nouveau Statut: {$event->nouveauStatut}");
    }
}

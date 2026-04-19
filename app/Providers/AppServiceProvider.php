<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Event; // La façade pour enregistrer les événements
use App\Events\CandidatureDeposee;
use App\Listeners\LogCandidatureDeposee;
use App\Events\StatutCandidatureMis;
use App\Listeners\LogChangementStatut;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // On lie manuellement les événements aux écouteurs
        Event::listen(
            CandidatureDeposee::class,
            LogCandidatureDeposee::class
        );

        Event::listen(
            StatutCandidatureMis::class,
            LogChangementStatut::class
        );
    }
}

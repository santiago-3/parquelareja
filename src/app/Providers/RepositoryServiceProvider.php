<?php

namespace App\Providers;

use App\Repositories\GuestRepository;
use App\Repositories\ReservationExtraRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\StateRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ActivityRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\PersonRepository;
// Add other repositories here as you create them

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Laravel auto-binds concrete classes, but we can explicitly 
        // bind them here to ensure the container handles them as singletons 
        // or to swap them for mocks during testing.
        
        $this->app->singleton(ActivityRepository::class);
        $this->app->singleton(PlaceRepository::class);
        $this->app->singleton(PersonRepository::class);
        $this->app->singleton(StateRepository::class);
        $this->app->singleton(ReservationRepository::class);
        $this->app->singleton(ReservationExtraRepository::class);
        $this->app->singleton(GuestRepository::class);
        $this->app->singleton(PriceItemRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Stokobat;
use App\Observers\StokObatObserver;
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
        StokObat::observe(StokObatObserver::class);
    }

}



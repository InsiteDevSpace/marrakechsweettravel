<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $conversionRates = [
                'USD' => 1,
                'EUR' => 0.85,
                'GBP' => 0.75,
            ];

            $view->with('conversionRates', $conversionRates);
        });
    }

}

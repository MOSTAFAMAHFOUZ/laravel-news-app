<?php

namespace App\Providers;

use App\Billing\PaymentGatway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatway::class, function () {
            return new PaymentGatway("USD");
        });
        $this->app->singleton("PaymentFacade", function ($app) {
            return
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}

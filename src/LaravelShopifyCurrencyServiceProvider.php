<?php

namespace Ownego\LaravelShopifyCurrency;

use Illuminate\Support\ServiceProvider;

class LaravelShopifyCurrencyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('shopify-currency', function ($app) {
            return new LaravelShopifyCurrency;
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/shopify-currency.php' => config_path('shopify-currency.php'),
            ], 'shopify-currency-config');

            $this->commands([
                Console\CacheShopifyCurrency::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shopify-currency.php', 'shopify-currency');
    }
}
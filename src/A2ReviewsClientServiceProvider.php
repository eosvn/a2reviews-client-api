<?php

namespace EOSVN\A2ReviewsClient;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * Class A2ReviewClientServiceProvider
 *
 * @package EOSVN\A2ReviewsClient
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class A2ReviewsClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/a2reviews_client.php', 'a2reviews_client');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/a2reviews_client.php' => config_path('a2reviews_client.php')
        ], 'a2reviews-client');
    }
}

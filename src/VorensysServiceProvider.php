<?php

namespace Lettingbox\Vorensys;

use Illuminate\Support\ServiceProvider;

class VorensysServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/vorensys.php' => config_path('vorensys.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/vorensys.php', 'vorensys');
    }
}

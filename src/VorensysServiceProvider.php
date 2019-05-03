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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('vorensys.php'),
            ], 'config');

            /*
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'vorensys');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/vorensys'),
            ], 'views');
            */
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'vorensys');
    }
}

<?php

namespace Lettingbox\Vorensys;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class VorensysServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/vorensys.php' => config_path('vorensys.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vorensys.php', 'vorensys');

        $this->app->bind('vorensys', function () {
            return (new Vorensys(new Client))
                ->setApiKey(config('vorensys.key'))
                ->setId(config('vorensys.id'))
                ->setUsername(config('vorensys.id'))
                ->setPassword(config('vorensys.password'));
        });
    }
}

<?php

namespace Module\UI;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class UIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/ui.php' => config_path('ui.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/public' => public_path('packages/module/ui'),
        ], 'public');
        $this->loadTranslationsFrom( __DIR__.'/lang', 'ui.nav');
        App::setLocale("en");

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'ui');
        $this->mergeConfigFrom( __DIR__.'/config/ui.php', 'ui');

        $this->app['asset'] = $this->app->share(function($app) {
            return new Asset();
        });
    }
}

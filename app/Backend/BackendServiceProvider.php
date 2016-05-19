<?php
namespace App\Backend;
use App\Backend\Navigation\NavigationManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {
    public function boot()
    {
        $navigationManager = new NavigationManager(__DIR__."/../Domain",new Filesystem(),'theme.nav');
        $navigationManager->initNavigation();
        $this->app['navigation'] = $this->app->share(function($app) use ($navigationManager){
            return $navigationManager;
        });
    }

    public function register(){

    }
}
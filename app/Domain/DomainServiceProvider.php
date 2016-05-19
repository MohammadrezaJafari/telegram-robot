<?php
namespace App\Domain;

use App\Domain\Content\Form\Content;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
class DomainServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $fileSystem = new Filesystem();
        $this->publishDomain($fileSystem);
        $this->loadTranslations($fileSystem);
//        $this->loadTranslationsFrom( __DIR__.'/Lang', 'domain');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function publishDomain(Filesystem $fileSystem)
    {
        $directories = $fileSystem->directories(__DIR__);
        foreach ($directories as $directory) {
            $configFileName = $fileSystem->allFiles($directory."/Config")[0]->getFileName();


            $this->publishes([
                 $directory . '/Config/' . $configFileName => config_path("domain/".$configFileName),
            ], 'config');

            $this->publishes([
                $directory .'/Database/Migrations' => database_path('migrations'),
                $directory .'/Database/Seeders' => database_path('seeds'),
            ], 'migrations');
        }
    }

    public function loadTranslations(Filesystem $fileSystem){
        $directories = $fileSystem->directories(__DIR__);
        foreach ($directories as $directory) {
            $domainName = lcfirst(explode("/",$directory)[count(explode("/",$directory))-1]);
            $this->loadTranslationsFrom( $directory . '/Lang/', "domain.$domainName");
        }
    }

}
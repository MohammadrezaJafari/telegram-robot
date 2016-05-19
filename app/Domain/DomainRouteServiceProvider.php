<?php
namespace App\Domain;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;

class DomainRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {


    }

    public function map(Router $router)
    {
        // register component routes
       $fileSystem = new Filesystem();
        foreach ($fileSystem->directories(__DIR__) as $directory) {
            //register resource route
            if($fileSystem->exists($directory."/Controller/Resource")){
                $domainName = explode("/",$directory)[count(explode("/",$directory))-1];
                $resoureceControllers = $fileSystem->allFiles($directory."/Controller/Resource");
                foreach ($resoureceControllers as $resoureceController) {
                    $rc = $resoureceController->getFileName();

                    $resourceName = substr($rc,0,-14);

                    $controllerName = $resourceName . "Controller";

                    $namespace = __NAMESPACE__."\\".$domainName.'\Controller\Resource';
                    $fullName = $namespace . "\\" . $controllerName;
                    $router->group(['prefix' => 'domain/'. lcfirst($domainName), 'middleware' => ['web', 'auth', 'authorize']], function() use($resourceName, $fullName, $router,$domainName)
                    {
                        $router->resource(lcfirst($resourceName), $fullName, ['names' => [
                            'create'  => lcfirst($domainName). "." . lcfirst($resourceName).".create",
                            'store'   => lcfirst($domainName). "." . lcfirst($resourceName).".store",
                            'index'   => lcfirst($domainName). "." . lcfirst($resourceName).".index",
                            'edit'    => lcfirst($domainName). "." . lcfirst($resourceName).".edit",
                            'update'    => lcfirst($domainName). "." . lcfirst($resourceName).".update",
                            'show'    => lcfirst($domainName). "." . lcfirst($resourceName).".show",
                            'destroy' => lcfirst($domainName). "." . lcfirst($resourceName).".destroy",
                        ]]);
                        $router->get("api/".lcfirst($resourceName), array('as'=> lcfirst($domainName). "." . lcfirst($resourceName).".table", 'uses'=> $fullName .'@getTable'));
                    });
                }
            }
            if($fileSystem->exists($directory."/Policy")){
                $policies = $fileSystem->allFiles($directory."/Policy");
                $gate = app(Gate::class);
                foreach ($policies as $policy) {
                    $className = substr($policy->getFileName(),0,-4);
                    $namespace = __NAMESPACE__ . "\\$domainName\\Policy";
                    $fullClassName = "$namespace\\$className";
                    $policyModel = substr($className,0,-6);
                    $prefix = 'domain-'.lcfirst($domainName)."-".strtolower($policyModel);
                    $gate->define("$prefix-index",  $fullClassName . '@index');
                    $gate->define("$prefix-create", $fullClassName . '@create');
                    $gate->define("$prefix-store",  $fullClassName . '@store');
                    $gate->define("$prefix-show",   $fullClassName . '@show');
                    $gate->define("$prefix-edit",   $fullClassName . '@edit');
                    $gate->define("$prefix-update", $fullClassName . '@update');
                    $gate->define("$prefix-destroy",$fullClassName . '@destroy');
                }

            }
        }

    }
}
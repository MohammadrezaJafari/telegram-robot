<?php

namespace App\Providers;

use App\Domain\Content\Content;
use App\Policies\ContentPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Content::class => ContentPolicy::class,

    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
//        $gate->define('update', 'App\Policies\ContentPolicy@update');
//        $gate->policy(Content::class,ContentPolicy::class);

//        $this->app['policy'] = $this->app->share(function($app) {
//            return new Asset();
//        });
//        $this->registerPolicies($gate);
//        var_dump($gate->getPolicyFor(Content::class));die;

        //
    }

    public function register()
    {

    }
}

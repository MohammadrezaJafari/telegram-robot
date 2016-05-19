<?php

namespace App\Providers;

use App\Domain\Content\Model\Content;
use App\Domain\Content\Policy\Resource\ContentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        var_dump(3);die;

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerPolicies(app(Gate::class));
    }
    public function registerPolicies(Gate $gate){
        $gate->define('domain-content-content-edit',ContentPolicy::class.'@edit');
        $gate->define('post-update',PostPolicy::class.'@update');
    }
}

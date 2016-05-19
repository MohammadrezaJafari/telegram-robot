<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    protected $route;
    protected $gate;

    public function __construct(Route $route,Gate $gate)
    {
        $this->route = $route;
        $this->gate = $gate;
    }
    public function handle(Request $request, Closure $next, $guard = null)
    {
        return $next($request);
        $route = $this->route->getName();
        $policy = str_replace(".","-","domain-$route");
        $resourcePath = explode("-",$policy);
        $model = "App\\".ucfirst($resourcePath[0])."\\".ucfirst($resourcePath[1])."\\Model\\".ucfirst($resourcePath[2]);
        $id = $this->route->getParameter($resourcePath[2]);
        if(is_null($id)){
            $resource = new $model;
        }
        else{
            $resource = $model::find($id);
        }
        if (!$this->gate->allows($policy, $resource, $request)) {
         //   var_dump('don\'t permission');
        }
        else{
            return $next($request);
        }
        return $next($request);



    }
}

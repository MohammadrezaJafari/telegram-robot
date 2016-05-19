<?php
/**
 * Created by PhpStorm.
 * User: mreza
 * Date: 4/29/16
 * Time: 3:42 PM
 */

namespace App\Domain;



use Illuminate\Filesystem\Filesystem;

class DomainBus {
    protected $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }
    public function getDomainResources()
    {
        $domains   = $this->fileSystem->directories(__DIR__);
        $resources = [];
        foreach ($domains as $domain) {

            if($this->fileSystem->exists($domain."/Policy/Resource/ResourceManager.php")){
                $domainName = lcfirst(explode("/",$domain)[count(explode("/",$domain))-1]);
                $resources[$domainName] = $this->getDomainResource($domainName);
            }

        }
        return $resources;
    }

    public function getDomainResource($domainName)
    {
        $ucDomainName = ucfirst($domainName);
        if($this->fileSystem->exists(__DIR__."/$ucDomainName/Policy/Resource/ResourceManager.php")){
            $resourceManager = "App\\Domain\\$ucDomainName\\Policy\\Resource\\ResourceManager";
            $rm = new $resourceManager($this->fileSystem);

            return $rm->getResources();
        }
    }
}
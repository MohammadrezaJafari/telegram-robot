<?php
namespace App\Domain\User\Policy\Resource;
use Illuminate\Filesystem\Filesystem;

class ResourceManager {
    protected $resources;
    protected $filesystem;
    protected $domainNamespace = "App\\Domain\\Content";

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getResources()
    {
        $resources = $this->filesystem->allFiles(__DIR__."/../../Controller/Resource");
        foreach($resources as $resource){
            $class = "$this->domainNamespace\\Controller\\Resource\\".substr($resource->getBasename(),0,-4);

            $resouceController = [
                'controller' => $class,
                'action' => [
                    [
                        'method'=>'index',
                        'item' => ['owner']
                    ],
                    ['method' => 'show'],
                    [
                        'method' => 'create',
                        'item'   => [
                            'title' , 'file'
                        ]
                    ],
                    ['method' => 'store'],
                    ['method' => 'edit'],
                    ['method' => 'update'],
                    ['method' => 'destroy']],
            ];
        }

        $this->resources = [
            'domain' => 'content',
            'controller' => [
                'resource' => [
                    'controller'   => 'Slide',
                    'action' => [
                        [
                            'method'=>'index',
                            'item' => ['owner']
                        ],
                        ['method' => 'show'],
                        [
                            'method' => 'create',
                            'item'   => [
                                'title' , 'file'
                            ]
                        ],
                        ['method' => 'store'],
                        ['method' => 'edit'],
                        ['method' => 'update'],
                        ['method' => 'destroy']],
                ]
            ],
            'navigation' => []
        ];

        return $this->resources;
    }

    public function getUserResource()
    {

    }
}
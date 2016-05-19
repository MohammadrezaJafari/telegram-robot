<?php
namespace App\Domain\Content\Policy;
use App\Backend\Core\Base\Form\FormFactory;
use App\Domain\Content\Model\Content;
use App\Domain\DomainBus;
use App\User;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContentPolicy {
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function edit(User $user, Content $post)
    {
        return $user->id == $post->user_id;
    }

    public function update(User $user, Content $post)
    {

    }

    public function create(User $user, Content $post)
    {
        App::bind('domain.content.form.content', function($app)
        {
            $domainBus = new DomainBus(new Filesystem());
            $resources = $domainBus->getDomainResources()['content']['controller']['resource']['action']['create']['item'];
            return FormFactory::getForm(get_class(new \App\Domain\Content\Form\Content()),null,$resources);
        });
        return true;
    }

    public function store(User $user, Content $post)
    {
        $data = $this->request->all();
        $domainBus = new DomainBus(new Filesystem());
        $resources = $domainBus->getDomainResources()['content']['controller']['resource']['action']['create']['item'];
        foreach ($resources as $resource) {
            if(array_key_exists($resource,$data)){
                unset($data[$resource]);
            }
        }
        if(array_key_exists('_token',$data)){
            if(count($data) == 1){
                return true;
            }
        }
        return false;
    }

    public function destroy(User $user, Content $post)
    {
        return $user->id === $post->user_id;
    }

    public function index(User $user, Content $post)
    {

    }

    public function show(User $user, Content $post)
    {

    }
}
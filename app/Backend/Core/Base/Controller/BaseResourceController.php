<?php

namespace App\Backend\Core\Base\Controller;

use App\Backend\Core\Base\Form\FormAbstract;
use App\Backend\Core\Base\Form\FormFactory;
use App\Backend\Core\Base\Model\BaseModel;
use App\Domain\DomainBus;
use App\Http\Requests;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Module\UI\Element\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class BaseResourceController extends BaseController
{
    protected $model;
    protected $form;
    protected $resources;

    public function __construct(BaseModel $model, FormAbstract $form){
        $this->model = $model;
        $this->form = $form;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $domainBus = new DomainBus(new Filesystem());
//        $this->resources = $domainBus->getDomainResources()['content']['controller']['resource']['action']['create']['item'];
//        $form = FormFactory::getForm(get_class(static::getForm()),null,$this->resources);
        return view('test',['element' => $this->form->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if($value instanceof UploadedFile){
                if(substr($value->getMimeType(), 0, 5) == 'image'){
                    $file = new File([]);
                    $file->setValue($value);
                    $this->model->{$key} = $file->getValue();
                    continue;
                }
            }
            if($key == '_token'){continue;}

            $this->model->{$key} = $value;
        }

        $this->model->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $model)
    {
        $modelClass = get_class(static::getModel());
        $model = $modelClass::find($id);
        $form = FormFactory::getForm(get_class(static::getForm()),$model);
        return view('test',['element' => $form->render()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = get_class(static::getModel());
        $slide = $model::find($id);
        $data = $request->all();
        foreach ($data as $key => $value) {
            if($key == "_method" || $key == '_token'){
                continue;
            }
            if($value instanceof UploadedFile){
                if(substr($value->getMimeType(), 0, 5) == 'image'){
                    $file = new File([]);
                    $file->setValue($value);
                    $slide->{$key} = $file->getValue();
                    continue;
                }
            }
            $slide->{$key} = $value;
        }
        $slide->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = get_class(static::getModel());
        $model::destroy($id);
        return redirect()->back();
    }

    protected function getForm()
    {
        return $this->form;
    }

    protected function getModel()
    {
        return $this->model;
    }
}

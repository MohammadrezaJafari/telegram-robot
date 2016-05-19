<?php

namespace App\Http\Controllers;

use App\Domain\Content\Content;
use App\Domain\Content\Form\FormAbstract;
use App\Domain\Content\Model\Slide;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Module\UI\Element\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BaseResourceController extends Controller
{
    protected $model;
    protected $form;
    public function __construct(Model $model, FormAbstract $form){
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
        $form = Content::getForm(get_class(static::getForm()));
        return view('test',['element' => $form->render()]);
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
        $model = get_class(static::getModel());
        $slide = $model::find($id);
        $form = Content::getForm(get_class(static::getForm()),$slide);
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

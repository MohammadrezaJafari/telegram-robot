<?php

namespace App\Domain\Content\Controller\Resource;

use App\Backend\Core\Base\Controller\BaseResourceController;
use App\Domain\Content\Content;
use App\Domain\Content\Form\Keyboard as KeyboardForm;
use App\Domain\Content\Model\Command;
use App\Domain\Content\Model\Keyboard;
use App\Http\Requests;

use App\User;
use Chumper\Datatable\Facades\DatatableFacade as Datatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\UI\Element\Button;
use Module\UI\Element\Hidden;
use Module\UI\Element\Select;
use Module\UI\Element\Textarea;
use Module\UI\Form;

class PreferencesController extends BaseResourceController
{
    public function __construct(Keyboard $keyboard, Keyboard $form){
        $this->model = $keyboard;
        $this->form  = $form;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function getTable()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $robot = User::where('id',auth()->user()->id)->first();
        $form  = new Form(['header' => "Preferences / About Robot",
            'action' =>  route('content.preferences.update',auth()->user()->id),
            'name'=>'preferences']);
        $form->addChild(new Textarea(['name' => 'about', 'row' => '5', 'label' => 'About Robot', 'value' => $robot->about,'placeholder' => 'About ...',
            'removeable' => false]));
        $form->addChild(new Hidden([
            'name' => '_method',
            'value' => "PUT",
        ]));
        $submit = new Button(['value' => trans("domain.content::form.Submit"), 'name' => 'submit']);
        $form->addChild($submit);

        return view('about',[ 'form' => $form->render()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edit($id,$model=null)
    {
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
        $robot = User::where('id',auth()->user()->id)->first();
        $robot->about = $request->get('about');
        $robot->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return parent::destroy($id);
    }
}

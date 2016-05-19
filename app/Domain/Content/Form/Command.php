<?php
namespace App\Domain\Content\Form;

use App\Backend\Core\Base\Form\FormAbstract;
use Illuminate\Support\Facades\URL;
use Module\UI\Element\Button;
use Module\UI\Element\File;
use Module\UI\Element\Hidden;
use Module\UI\Element\Text;
use Module\UI\Form;


class Command extends FormAbstract{
    protected $form;
    public function getForm($model=null)
    {

        $id = (isset($model->id))?$model->id:"";
        $route = route('content.telegram.store');
        if($id !=""){
            $put = new Hidden([
                'name' => '_method',
                'value' => "PUT",
            ]);
            $this->form     = new Form(['header' => trans("domain.content::form.Add New Command"),
                'action' =>  route('content.telegram.update',$id),
                'name'=>'command']);
            $this->form->addChild($put);
        }
        else{

            $this->form     = new Form(['header' => trans("domain.content::form.Add New Command"),
                'action' =>  route('content.telegram.store'),
                'name'=>'command']);
        }


        $pageTitle = new File([
            'name' => 'image',
            'placeholder' => trans("domain.content::form.Title"),
            'value' => (isset($model->image))?$model->image:"",
            'label' => 'Image Title',
        ]);

        $commandName = new Text([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => trans("domain.content::form.Title"),
            'value' => (isset($model->name))?$model->name:"",
            'label' => 'Command Name',
        ]);



        $submit = new Button(['value' => trans("domain.content::form.Submit"), 'name' => 'submit']);
        $this->form->addChild($commandName);
        $this->form->addChild($submit);

        return $this->form;
    }
}
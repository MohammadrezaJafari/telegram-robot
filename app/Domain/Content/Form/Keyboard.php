<?php
namespace App\Domain\Content\Form;

use App\Backend\Core\Base\Form\FormAbstract;
use Illuminate\Support\Facades\URL;
use Module\UI\Element\Button;
use Module\UI\Element\File;
use Module\UI\Element\Hidden;
use Module\UI\Element\Text;
use Module\UI\Element\Textarea;
use Module\UI\Form;
use Module\UI\Set\FieldSet;
use Module\UI\Set\TabSet;


class Keyboard extends FormAbstract{
    public function getForm($model=null)
    {

        $id = (isset($model->id))?$model->id:"";
        $form     = new Form(['header' =>trans("ui::form.Add New Product"),
            'action' =>  URL::to('domain/product/' . $id),
            'name'=>'page']);
        if($id !=""){
            $put = new Hidden([
                'name' => '_method',
                'value' => "PUT",
            ]);
            $form->addChild($put);
        }

        $keyboardName = new Text([
            'name' => 'title',
            'placeholder' => trans("ui::form.Title") ,
            'type' => 'text',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans("ui::form.Product Title"),
        ]);


        $submit = new Button(['value' => trans("ui::form.Submit"), 'name' => 'submit']);

        $form->addChild($keyboardName);
        $form->addChild($submit);

        return $form;
    }
}
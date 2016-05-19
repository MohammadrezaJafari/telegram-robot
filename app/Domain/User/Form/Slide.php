<?php
namespace App\Domain\Content\Form;

use Illuminate\Support\Facades\URL;
use Module\UI\Element\Button;
use Module\UI\Element\CKEditor;
use Module\UI\Element\File;
use Module\UI\Element\Hidden;
use Module\UI\Element\Text;
use Module\UI\Element\Textarea;
use Module\UI\Form;


class Slide extends FormAbstract{
    public function getForm($model=null)
    {

        $id = (isset($model->id))?$model->id:"";
        $form     = new Form(['header' => trans("domain.content::form.Add New Slide"),
            'action' =>  URL::to('domain/slide/' . $id),
            'name'=>'page']);
        if($id !=""){
            $put = new Hidden([
                'name' => '_method',
                'value' => "PUT",
            ]);
            $form->addChild($put);
        }

        $pageTitle = new File([
            'name' => 'image',
            'placeholder' => trans("domain.content::form.Title"),
            'value' => (isset($model->image))?$model->image:"",
            'label' => 'Image Title',
        ]);


        $editor = new Textarea([
            'name' => 'description',
            'placeholder' => trans("domain.content::form.Description") .' ...',
            'label' => trans("domain.content::form.Description"),
            'value' => (isset($model->description))?$model->description:"",
        ]);

        $submit = new Button(['value' => trans("domain.content::form.Submit")]);

        $form->addChild($pageTitle);
        $form->addChild($editor);
        $form->addChild($submit);

        return $form;
    }
}
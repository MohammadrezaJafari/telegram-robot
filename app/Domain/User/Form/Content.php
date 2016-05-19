<?php
namespace App\Domain\Content\Form;

use Illuminate\Support\Facades\URL;
use Module\UI\Element\Button;
use Module\UI\Element\CKEditor;
use Module\UI\Element\File;
use Module\UI\Element\Hidden;
use Module\UI\Element\Select;
use Module\UI\Element\Text;
use Module\UI\Element\Textarea;
use Module\UI\Form;
use Module\UI\Set\FieldSet;
use Module\UI\Set\TabSet;


class Content extends FormAbstract{
    public function getForm($model=null)
    {

        $id = (isset($model->id))?$model->id:"";
        $form     = new Form(['header' =>trans("ui::form.Add New Content"),
            'action' =>  URL::to('domain/content/' . $id),
            'name'=>'page']);
        if($id !=""){
            $put = new Hidden([
                'name' => '_method',
                'value' => "PUT",
            ]);
            $form->addChild($put);
        }

        $title = new Text([
            'name' => 'title',
            'placeholder' => trans("ui::form.Title") ,
            'type' => 'text',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans("ui::form.Content Title"),
        ]);

        $image = new File([
            'name' => 'image',
            'value' => (isset($model->image))?$model->image:"",
            'label' => trans("ui::form.Image"),
        ]);

        $summary = new Textarea([
            'name' => 'summary',
            'placeholder' => trans("ui::form.Summary") .' ...',
            'label' => trans("ui::form.Summary"),
            'value'=>(isset($model->summary))?$model->summary:"",
        ]);

        $submit = new Button(['value' => trans("ui::form.Submit")]);

        $description = new CKEditor([
            'name' => 'description',
            'placeholder' => trans("ui::form.Description").' ...',
            'label' => trans("ui::form.Description"),
            'value'=>(isset($model->description1))?$model->description1:"",
        ]);

        $form->addChild($title);
        $form->addChild($image);
        $form->addChild($summary);
        $form->addChild($description);
        $form->addChild($submit);

        return $form;
    }
}
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
use Module\UI\Set\FieldSet;
use Module\UI\Set\TabSet;


class Order extends FormAbstract{
    public function getForm($model=null)
    {

        $id = (isset($model->id))?$model->id:"";
        $form     = new Form(['header' =>trans("ui::form.Add New Product"),
            'action' =>  URL::to('domain/product/' . $id),
            'name'=>'page']);
        $tab = new TabSet();
        if($id !=""){
            $put = new Hidden([
                'name' => '_method',
                'value' => "PUT",
            ]);
            $form->addChild($put);
        }

        $ProductTitle = new Text([
            'name' => 'title',
            'placeholder' => trans("ui::form.Title") ,
            'type' => 'text',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans("ui::form.Product Title"),
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
        $fieldSet = new FieldSet(['name' => 'serviceEn','header' => '' , 'label' => trans("ui::form.Product Info")]);

        $image1 = new File([
            'name' => 'image1',
            'value' => (isset($model->image1))?$model->image1:"",
            'label' => trans("ui::form.Image").'1',
        ]);
        $description1 = new Textarea([
            'name' => 'description1',
            'placeholder' => trans("ui::form.Description").' ...',
            'label' => trans("ui::form.Description").' 1',
            'value'=>(isset($model->description1))?$model->description1:"",
        ]);

        $image2 = new File([
            'name' => 'image2',
            'placeholder' => 'Title',
            'value' => (isset($model->image2))?$model->image2:"",
            'label' => trans("ui::form.Image").'2',
        ]);
        $description2 = new Textarea([
            'name' => 'description2',
            'placeholder' => trans("ui::form.Description") .' ...',
            'label' => trans("ui::form.Description").'2',
            'value'=>(isset($model->description2))?$model->description2:"",
        ]);

        $image3 = new File([
            'name' => 'image3',
            'placeholder' => 'Title',
            'value' => (isset($model->image3))?$model->image3:"",
            'label' => trans("ui::form.Image").'3',
        ]);

        $description3 = new Textarea([
            'name' => 'description3',
            'placeholder' => trans("ui::form.Description") .' ...',
            'label' => trans("ui::form.Description") . "3",
            'value'=>(isset($model->description3))?$model->description3:"",
        ]);
        $fieldSet1 = new FieldSet(['name' => 'prodinfo','header' => '' , 'label' => trans("ui::form.Product Details")]);

        $fieldSet1->addChild($image1);
        $fieldSet1->addChild($description1);

        $fieldSet1->addChild($image2);
        $fieldSet1->addChild($description2);

        $fieldSet1->addChild($image3);
        $fieldSet1->addChild($description3);

        $fieldSet->addChild($ProductTitle);
        $fieldSet->addChild($image);
        $fieldSet->addChild($summary);
        $tab->addChild($fieldSet);
        $tab->addChild($fieldSet1);
        $form->addChild($tab);
        $form->addChild($submit);

        return $form;
    }
}
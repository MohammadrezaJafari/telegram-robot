<?php
/**
 * Created by PhpStorm.
 * User: mreza
 * Date: 1/23/16
 * Time: 8:34 PM
 */

namespace App\Http\Controllers;


use App\Domain\Content\Content;
use Module\UI\Element\Assign;
use Module\UI\Element\Button;
use Module\UI\Element\CheckBox;
use Module\UI\Element\CKEditor;
use Module\UI\Element\Date;
use Module\UI\Element\Select;
use Module\UI\Element\Text;
use Module\UI\Element\Textarea;
use Module\UI\Form;
use Module\UI\Set\FieldSet;
use Module\UI\Set\TabSet;

class UserController extends Controller{
    public function getIndex()
    {
        $header = (isset($currentService))?"Edit Service":"Business Management";

        $form     = new Form(['header' => $header,
            'action' =>  "user/b2b/sellrequest",
            'name'=>'serviceForm']);

        $tab = new TabSet();

        $fieldsetFa = new FieldSet(['name' => 'serviceFa','header' => 'Create New Sell Request' , 'label' => 'Request']);

        $serviceNameFa = new Text([
            'name' => 'title',
            'placeholder' => 'Title',
            'type' => 'text',
            'value' => "",
            'label' => 'Title',
        ]);

        $priceText = new Text([
            'name' => 'price',
            'placeholder' => '000.000',
            'type' => 'text',
            'value' => "",
            'label' => 'Price',
        ]);

        $numberText = new Text([
            'name' => 'number',
            'placeholder' => '0',
            'type' => 'text',
            'value' => "",
            'label' => 'Number',
        ]);

        $unitText = new Text([
            'name' => 'unit',
            'placeholder' => ('KG'),
            'type' => 'text',
            'value' => "",
            'label' => ('Unit'),
        ]);


        $descriptionFa = new Textarea([
            'name' => 'description',
            'placeholder' => ('Description') .' ...',
            'label' => ('Description'),
            'value'=>"",
        ]);

        $editor = new CKEditor([
            'name' => 'description',
            'placeholder' => ('Description') .' ...',
            'label' => ('Description'),
            'value'=>"",
        ]);

//        $alloIFa = new File([
//            'name' => 'technical_report',
//            'value' => '',
//            'label' => ('Technical Report'),
//        ]);
//
//        $imageFile = new File([
//            'name' => 'image',
//            'value' => '',
//            'label' => ('Image'),
//        ]);
//
        $expireDate = new Date([
            'name' => 'expireDate',
            'value' => '',
            'label' => ('Expire Time'),
        ]);

        $status = new CheckBox([
            'name' => 'expireDate',
            'value' => '',
            'checked' => false,
            'label' => ('Status'),
        ]);




        $fieldsetFa->addChild($serviceNameFa, 'serviceNameFa');
        $fieldsetFa->addChild($priceText);
        $fieldsetFa->addChild($numberText);
        $fieldsetFa->addChild($editor);
        $fieldsetFa->addChild($unitText);
//        $fieldsetFa->addChild($alloIFa, 'serviceNameFa');
//        $fieldsetFa->addChild($imageFile);
        $fieldsetFa->addChild($expireDate);
        $fieldsetFa->addChild($descriptionFa, 'username');
        $fieldsetFa->addChild($status);

        $submit = new Button(['value' => 'Submit']);

//        $treeSelect = new TreeSelect([
//            "title"=> ("choose category of your service"),
//            "services"=>$services,
//            "selected"=>(isset($currentService[0]["parent"]))?$currentService[0]["parent"]:"",
//            "name" => "parent",
//        ]);
//        $fieldsetFa->addChild($treeSelect);
        $assign = new Assign([
            "selected" => [],
            "unselected" => [],
            "title"=> "users"
        ]);
        $fieldsetEn = new FieldSet(['name' => 'serviceEn','header' => 'Create New Sell Request' , 'label' => 'Assign']);

        $fieldsetEn->addChild($assign);


        $tab->addChild($fieldsetFa, 'fieldsetFa');
        $tab->addChild($fieldsetEn, 'fieldsetEn');
        $form->addChild($tab);
        $form->addChild($submit, 'submit');
        $page = Content::getForm('page');
        return view('test',['element' => $page->render()]);
    }
}
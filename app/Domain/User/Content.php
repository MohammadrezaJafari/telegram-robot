<?php
namespace App\Domain\Content;

class Content {
    public static function getForm($name,$model=null){
//        $obj = 'App\Domain\Content\Form\\'.ucfirst($name);
        $form = new $name();
        return $form->getForm($model);
    }
}
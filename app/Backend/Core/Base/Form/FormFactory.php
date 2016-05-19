<?php
/**
 * Created by PhpStorm.
 * User: mreza
 * Date: 4/25/16
 * Time: 11:50 AM
 */

namespace App\Backend\Core\Base\Form;


class FormFactory {
    public static function getForm($name,$model=null,$resources=null){
        $form = new $name();
        $permittedForm = $form->getForm($model);

        foreach ($permittedForm->getChildren() as $child) {
            if(!in_array($child->getName(),$resources)){
                $permittedForm->removeChild($child->getName());
            }
        }
        return $permittedForm;
    }
}
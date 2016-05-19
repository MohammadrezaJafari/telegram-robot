<?php
namespace App\Domain\User\Form;

use Illuminate\Support\Facades\URL;
use Module\UI\Element\Button;
use Module\UI\Element\CKEditor;
use Module\UI\Element\File;
use Module\UI\Element\Text;
use Module\UI\Form;


class User extends FormAbstract{
    public function getForm($model=null)
    {
        $form     = new Form(['header' => trans("domain.user::form.Add New User"),
            'action' =>  route('user.user.create'),
            'name'=>'create-user']);

        $firstName = new Text([
            'name' => 'first_name',
            'placeholder' => trans('domain.user::form.First Name'),
            'type' => 'text',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans('domain.user::form.First Name'),
        ]);

        $lastName = new Text([
            'name' => 'last_name',
            'placeholder' => trans('domain.user::form.Last Name'),
            'type' => 'text',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans('domain.user::form.Last Name'),
        ]);

        $email = new Text([
            'name' => 'email',
            'placeholder' => trans('example@domain.com'),
            'type' => 'text',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans('domain.user::form.Email'),
        ]);

        $password = new Text([
            'name' => 'password',
            'placeholder' => trans('domain.user::form.Password'),
            'type' => 'password',
            'value' => (isset($model->title))?$model->title:"",
            'label' => trans('domain.user::form.Password'),
        ]);

        $submit = new Button(['value' => trans('domain.user::form.Submit')]);

        $form->addChild($firstName);
        $form->addChild($lastName);
        $form->addChild($email);
        $form->addChild($password);
        $form->addChild($submit);

        return $form;
    }
}
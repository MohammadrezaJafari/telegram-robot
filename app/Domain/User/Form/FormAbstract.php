<?php
namespace App\Domain\User\Form;


abstract class FormAbstract {
    public abstract function getForm($model=null);
}
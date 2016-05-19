<?php

namespace Module\UI\Set;

use Module\UI\Set;


class FieldSet extends Set{
    public function __construct($variables = null, $options = null)
    {
        $this->setTemplate('ui/form/set/fieldset');
        parent::__construct($variables, $options);
    }

    public function render(){
        return view('ui::form.set.fieldset',['children' => $this->getChildren()]);
    }
}
<?php

namespace Module\UI\Element;


use Module\UI\Element;

class CheckBox extends Element{
    public function __construct($variables = null, $options = null)
    {
        $this->setTemplate('checkbox');
        parent::__construct($variables, $options);
    }

    public function render(){
        return parent::render();
    }
}
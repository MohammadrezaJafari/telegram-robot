<?php

namespace Module\UI\Element;


use Module\UI\Element;

class Assign extends Element
{
    public function __construct($variables = null, $options = null){
        $this->setTemplate('assign');
        parent::__construct($variables, $options);
    }

    public function render(){
        return parent::render();
    }

}
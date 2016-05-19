<?php

namespace Module\UI\Element;

use Module\UI\Element;

class Text extends Element{
    public function __construct($variables = null, $options = null)
    {
        $this->setTemplate('text');
        parent::__construct($variables, $options);

    }

    public function render(){
        return parent::render();
    }
}
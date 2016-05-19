<?php

namespace Ellie\UI\Element;

use Ellie\UI\Element;

class FileUpload extends Element{
    public function __construct($variables = null, $options = null)
    {
        $this->setTemplate('ui/form/element/multi-upload');
        parent::__construct($variables, $options);
    }

    public function render(){
        return parent::render();
    }
}
<?php

namespace Module\UI\Element;

use Ellie\UI\Element;
use Module\UI\Element\File;
use Zend\File\Transfer\Adapter\Http;
use Zend\Filter\File\Rename;
use Zend\Validator\File\Extension;
use Zend\Validator\File\Size;

class FileCustom extends File{
    protected $description;
    public function __construct($name, $attributes = []){
        parent::__construct($name, $attributes);
        $this->setDescription($name['value']);
        $this->setTemplate('filecustom');
    }

    public function setValue($value)
    {
        return parent::setValue($value['data']);
    }

    public function setDescription($value)
    {
        $this->description = $value['description'];
    }

    public function render()
    {

        $this->setVariables(['description'=>$this->description]);
        return parent::render();
    }

}
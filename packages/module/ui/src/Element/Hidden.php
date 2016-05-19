<?php
namespace Module\UI\Element;


use Module\UI\Element;

class Hidden extends Element
{
    public function __construct($name, $attributes = [])
    {
        $this->setTemplate('hidden');

        parent::__construct($name, $attributes);
    }
}
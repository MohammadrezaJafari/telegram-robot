<?php
namespace Module\UI\Set;

use Module\UI\Set;


class TabSet extends Set{
    public function __construct($variables = null, $options = null)
    {
        $this->setTemplate('tab');
        parent::__construct($variables, $options);
    }

    public function render(){
        return view('ui::form.set.tab',['children' => $this->getChildren(),'variables' => $this->getVariables()]);
    }
}
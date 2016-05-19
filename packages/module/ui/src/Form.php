<?php
/**
 * Created by PhpStorm.
 * User: mreza
 * Date: 1/23/16
 * Time: 6:26 PM
 */

namespace Module\UI;


class Form extends Set{
    public function render(){
        return view('ui::form.form',['children' => $this->getChildren(), 'variables' => $this->getVariables()]);
    }
}
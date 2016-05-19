<?php

namespace Module\UI\Set;

use Exception;
use Module\UI\Set;


/**
 * Class ArraySet
 * @package Paydar\Form\Set
 */
class ArraySet extends Set
{
    /**
     * All items that are currently added or filled
     * @var [] of Fieldset
     */
    protected $sampleObject;
    protected $attributes;
    protected $prefix;
    /**
     * Construct
     *
     * @param string $name Name
     * @param array $attributes attributes
     */
    public function __construct($variables = null, $options = null)
    {
        $changable = isset($attributes['changeable'])?$attributes['changeable']:true;
        $this->setChangeable($changable);

        $max = isset($attributes['max'])?$attributes['max']:0;
        $this->setMax($max);

        $min = isset($attributes['min'])?$attributes['min']:1;
        $this->setMin($min);

        $dragable = isset($attributes['dragable'])?$attributes['dragable']:false;
        $this->setDragable($dragable);
        $this->setTemplate('arrayset');
        parent::__construct($variables, $options);
//        parent::__construct($name, $attributes);
        $this->setPrefix($variables['name']);

    }
    /**
     * Return element name
     *
     * @param string $prefix
     * @return string
     */
    public function setPrefix($prefix)
    {
        return $this->prefix = $prefix;
    }

    /**
     * Return element name
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }


    /**
     * Set  Changeable
     *
     * @param bool $value
     */
    public function setChangeable($value)
    {
        if ($value){
            $this->attributes['changeable'] = true;
        }else{
            $this->attributes['changeable'] = false;
        }

    }

    /**
     * Get Changeable
     *
     */
    public function getChangeable()
    {
        if ($this->attributes['changeable'])
            return true;
        return false;
    }

    /**
     * Set  dragable
     *
     * @param bool $dragable
     */
    public function setDragable($dragable)
    {
        if ($dragable){
            $this->attributes['dragable'] = true;
        }else{
            $this->attributes['dragable']= false;
        }

    }

    /**
     * Get dragable
     *
     */
    public function getDragable()
    {
        if ($this->attributes['dragable'])
            return true;
        return false;

    }

    /**
     * Set  min
     *
     * @param int $min
     * @throws Exception if minimum is not valid
     */
    public function setMin($min)
    {
        if ($min >= 1){
            $this->attributes['min']=$min;
        }else
            throw new Exception("minimum of ArraySet can not be less than one", 1);
    }

    /**
     * Get  min
     */
    public function getMin()
    {
        return $this->attributes['min'];
    }

    /**
     * Set  max
     *
     * @param int $max //zero value means infinite time user can add an item in view
     * @throws Exception if maximum is not valid
     */
    public function setMax($max = 0)
    {
        if ($max >= 0) {
            $this->attributes['max'] = $max;
        } else {
            throw new Exception("max can not be negative (zero means infinite)", 1);
        }
    }

    /**
     * Get  max
     */
    public function getMax()
    {
        return $this->attributes['max'];
    }

    /**
     * Return values of the all elements
     *
     * @return array
     */
    public function getValue()
    {
        array_shift($this->children);
        return parent::getValue();
    }

    /**
     * Add a child
     *
     * @param Element|Set $child Child
     *
     * @throws Exception
     */
    public function addChild($child, $captureTo = null, $append = null)
    {

        if (!$this->sampleObject) {
            $this->sampleObject = clone $child;
//            $this->sampleObject->emptyValues();

//            return;
            // throw new Exception("you have to set sample first", 1);   
        }

        //TODO :check if the childs is the same
        $tmpObj = $this->getNewItemObj();
        $tmpObj->fill($child->getValue());

        $index = count($this->children);
//        $tmpObj->setName($index);
//        $tmpObj->setPrefix((string)$index);

        return parent::addChild($tmpObj);

    }

    /**
     * Get all children values
     *
     * @throws Exception
     * @internal param mixed $source Request source
     */
    public function getNewItemObj()
    {
        if (!$this->sampleObject) {
            throw new Exception("you have to set at least one child first", 1);
        }

        return clone $this->sampleObject;
    }

    /**
     * Set all children values
     *
     * @param mixed $source Request source
     * @param bool $init
     * @throws Exception
     */
    public function fill($source, $init = false)
    {
        if (!is_array($source))
            throw new Exception("you most send an array of each element value to fill function of ArraySet", 1);
        if ($this->getMax() != 0 && count($source) > $this->getMax())
            throw new Exception("length of fill inputs is more than maximum allowed object", 1);

        if ($this->getMax() > 0 && count($source) > $this->getMax()) {
            throw new Exception("maximum allowed items exceeded(more than " . $this->getMax() . ")", 1);
        }
        ///finding max length of items

        foreach ($source as $name => $val) {
            $child = null;
            if (is_string($name) && strlen($name) > 0) {
                $child = $this->getChild($name);
            }
            $check = false;
            if (!$child) {
                $check = true;
                $child = $this->getNewItemObj();
            }

            $child->fill($val);

            if ($check) {
                $this->addChild($child, true);
            }
        }
    }

    /**
     * Render
     *
     * @param string $view View path
     * @throws Exception
     * @return string
     */
    public function render($view = '')
    {
        if (!$this->sampleObject)
            throw new Exception("you have to initial array set to process items in page", 1);

        if (!$this->getPrefix()){
            $this->setPrefix($this->getName());
        }

        // extra nodes for cover min items
        for ($i = count($this->children); $i < $this->getMin()+1; $i++) {
            $child = $this->getNewItemObj();
            $this->addChild($child, true);
        }


        $this->setVariable('min', $this->getMin());
        $this->setVariable('max', $this->getMax());
        return view('ui::form.set.arrayset',['object' => $this,'children' => $this->getChildren(),'variables' => $this->getVariables()]);

        return parent::render($view);
    }
}

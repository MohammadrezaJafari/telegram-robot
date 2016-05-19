<?php

namespace Module\UI;


class Set extends Item{

    /**
     * Child models
     * @var array
     */
    protected $children = [];

    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);
    }

    public function addChild($child, $captureTo = null, $append = null)
    {
//        var_dump($child->getName());
//        echo "<br>";
        // Todo: Check child type and name
        if (!$child instanceof Element && !$child instanceof set) {
            throw new \Exception('Child type is not valid.');
        }
        if (array_key_exists($child->getName(), $this->getChildren())){
//            var_dump($this->getChildren());

//            throw new \Exception('Child with name '.$child->getName().' exist in '.$this->getName().' ['.get_class($this).']');
        }

        $child->setParent($this);
        $this->children[$child->getName()] = $child;
    }

    /**
     * Recursive search on children and return child
     *
     * @param string $name Name
     *
     * @return bool|Element|Set
     */
    public function getChild($name)
    {
        if (array_key_exists($name, $this->children)) {
            return $this->children[$name];
        }

        return false;
    }

    /**
     * Recursive search on children and return child
     *
     * @param string $name Name
     *
     * @return bool|Element|Set
     */
    public function removeChild($name)
    {
        if (array_key_exists($name, $this->children)) {
            unset($this->children[$name]);
        }

        return false;
    }

    /**
     * remove all child of a set
     */
    public function removeAllChild()
    {
        $this->children = [];
    }

    /**
     * remove all child of a set
     */
    public function emptyValues()
    {
        foreach($this->getChildren() as $child){
            if ($child instanceof Element) {
                $child->setValue('');
            }

            if ($child instanceof Set) {
                $child->emptyValues();
            }
        }
    }

    /**
     * Return children
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Recursive search on children and return value of a child
     *
     * @param string $name Name
     *
     * @return mixed
     */
    public function getChildValue($name)
    {
        $child = $this->getChild($name);
        if ($child instanceof Item)
            return $child->getValue();
        return $child;
    }

    /**
     * Return values of the form
     *
     * @return array
     */
    public function getValue()
    {
        $values = [];

        foreach ($this->children as $childName => $child) {
            $val = $child->getValue();

            if ($child instanceof Set) {
                $prefix = $child->getPrefix();
                if (is_integer($prefix))
                    $prefix = (string)$prefix;
                if (is_null($prefix) || !is_string($prefix) || strlen($prefix) == 0) {
                    $values = array_merge($values, $val);
                    continue;
                } else {
                    $values[$child->getPrefix()] = $val;
                }
            } else {
                $values[$childName] = $val;
            }
        }
        return $values;
    }

    /**
     * Return values of the all elements with name $name
     *
     * @return array
     */
    public function getElement($name)
    {
        $values = [];

        foreach ($this->children as $childName => $child) {
            if ($child instanceof Element and $child->getName() == $name)
                $values[] = $child;
            elseif ($child instanceof Set)
                $values = array_merge($values, $child->getElement($name));
        }
        return $values;
    }

    /**
     * Set all children values
     *
     * @param mixed $source Request source
     * @param bool  $init   Set init value
     */
    public function fill($source)
    {
        $prefix = $this->getPrefix();
        if ($prefix && array_key_exists($prefix, $source)) {
            $source = $source[$prefix];
        }

        foreach ($this->getChildren() as $name => $child) {
            if ($child instanceof Set) {
//                try {
                if ($child->getPrefix() && is_array($source) && array_key_exists($child->getPrefix(), $source)) {
                    $child->fill($source[$child->getPrefix()]);
                } elseif (!$child->getPrefix()) {
                    $child->fill($source);
                }
//                }catch(\ErrorException $e){
//
//                    var_dump('asda');die;
//
//                }

            } else {//if instanceof Element
                if (array_key_exists($child->getName(), (array)$source)) {
                    $child->setValue($source[$child->getName()]);

                }
            }
        }
        return;
    }

    /**
     * Validate all children
     *
     * @throws ValidationException
     * @return boolean true on success and false on failure
     */
    public function validate($messages = [])
    {

        foreach ($this->children as $childName => $child) {
            try {
                $child->validate($messages);
            } catch (ValidationException $exception) {
                if($child instanceof Element){
                    $fieldName = $child->getName();
                    if(!is_null($child->getParent())){
                        $fieldName = $child->getLabel();
                    }

                    $messages[$fieldName]['message'] = $exception->getMessage();
                    $messages[$fieldName]['id'] = $child->getElementId();
                }else{

                    $messages = array_merge(
                        $messages,
                        json_decode($exception->getMessage(),true));
                }
            }
        }

        if (count($messages)) {
            throw new ValidationException(json_encode($messages));
        }

        return true;
    }

    public function render(){

        return parent::render();
    }

}
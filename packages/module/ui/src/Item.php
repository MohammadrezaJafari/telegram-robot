<?php

namespace Module\UI;

class Item extends ViewModel{

    protected $attribute;
    protected $permission;
    protected $name;
    protected $id;
    protected $label;
    protected $parent;
    protected $prefix;


    public function __construct($variables, $options = [])
    {

        $variables['label'] = (!isset($variables['label']))?"":$variables['label'];
        $variables['id'] = (!isset($variables['id']))?"":$variables['id'];
        $this->name = (!isset($variables['name']))?"":$variables['name'];;
        $this->label = $variables['label'];
        $this->id = $variables['id'];

        parent::__construct($variables, $options);
    }

    /**
     * Set set parent
     *
     * @params $parent Set $parent Parent
     */
    public function setParent($parent)
    {
        if($parent instanceof set){
            return $this->parent = $parent;
        }
        throw new Exception("parent most be of Set class type", 1);

    }

    /**
     * Get set parent
     *
     */
    public function getParent()
    {
        return  $this->parent;
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

    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set value
     *
     * @param $value
     */
    public function setLabel($value)
    {
        $this->label =trim($value);
    }

    /**
     * Get value
     *
     */
    public function getLabel()
    {
        return $this->label ;
    }

    /**
     * Return all attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set element name
     *
     * @param $name
     * @throws \Exception
     */
    public function setName($name)
    {
        if(is_null($name)){
            throw new \Exception('name is null .you can not create a form Element with no name.');
        }
        $this->name = $name;
    }

    /**
     * Return element name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId()
    {
        if($this->id == ''){
            $this->id = $this->name;
        }
        return $this->id;
    }

    /**
     * @return array|string
     * @throws Exception
     */
    public function getParentPrefixes(){
        if($this instanceof Form )
            return "";
        if(! $this->parent){
            $tmp = $this->getPrefix();
            if(is_null($tmp) || strlen($tmp)=="")
                return $this->getName();
            return $this->getPrefix();
        }
        $parent_prefix = $this->parent->getParentPrefixes();


        if($this instanceof Set)
            $self_prefix = $this->getPrefix();
        else if( $this instanceof Element)
            $self_prefix = $this->getName();
        else
            throw new Exception("this element is not valid", 1);

        if(strlen($self_prefix)==0)
            return $parent_prefix;

        if(
            (is_array($parent_prefix) &&count($parent_prefix)==0) ||
            (is_string($parent_prefix) &&strlen($parent_prefix)==0)
        ){

            return $self_prefix;
        }

        $ans = [];
        if(is_array($parent_prefix)){
            $ans = $parent_prefix;
        }else{
            $ans[] = $parent_prefix;
        }
        $ans[] = $self_prefix;
        return $ans;

    }

    /**
     * recursively get parents prefixes and join them and return a unique
     * element name
     *
     * @return string
     */
    public function getElementName(){
        $ancestor = $this->getParentPrefixes();
        $ans='';

        if(is_array($ancestor)){
            foreach ($ancestor as  $value) {
                if($ans==''){
                    $ans.=$value;
                    continue;
                }
                $ans.='['.$value.']';
            }
        }else{
            $ans = $ancestor;
        }
        return $ans;
    }

    /**
     * @return array|string
     * @throws Exception
     */
    public function getElementId(){
        $ancestor = $this->getParentPrefixes();
        $ans='';

        if(is_array($ancestor)){
            foreach ($ancestor as  $value) {
                if($ans!=''){
                    $ans.='-';
                }
                $ans.=$value;
            }
        }else{
            $ans = $ancestor;
        }
        str_replace('[','-S-',$ans);
        str_replace(']','-E',$ans);
        return $ans;
    }

    /**
     * Render
     *
     * @return string
     */
    public function render()
    {
        $type='element';
        if($this instanceof Set){
            $type='set';
        }
        $this->setVariables(
            [
                'label' => $this->getLabel(),
                'name'  => $this->getName(),
                'id'    => $this->getId()
            ]
        );
        return view("ui::form.$type." .static::getTemplate(),['children' => $this->getChildren(),'variables' => $this->getVariables(), 'object' => $this]);

//
//        $this->setRenderVariable('elemName', $this->getElementName());
//        $this->setRenderVariable('attributes', $this->getAttributes());
//        $this->setRenderVariable('label', $this->getLabel());
//        $this->setRenderVariable('object', $this);
//
//        $reflect = new \ReflectionClass($this);
//
//        return (string)$this->getBlade()->view()->make(
//            $type.'.'.strtolower($reflect->getShortName()),
//            $this->renderVariables
//        )->render();
    }

    /**
     * Deep copy object
     * @throws Exception
     */
    public function __clone() {
        $setChildren =[];
        if($this instanceof Set){
            foreach ($this->getChildren() as $chName => $child) {
                $setChildren[] = clone $child;
            }
        }
        $this->children = [];

        foreach ($setChildren as $key => $setCh) {
            $this->addChild($setCh);
        }

    }
}
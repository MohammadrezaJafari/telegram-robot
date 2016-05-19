<?php
namespace Module\UI;

class Element extends Item{


    /**
     * @var value of elements
     */
    protected $value;
    protected $rules;
    protected $removeable = false;
    /**
     * @var array[] validation filter
     */
    protected $validationFilter=[];

    /**
     * Constructor
     *
     * @param string $name element name
     * @param array $attributes Attributes
     */
    public function __construct($variables = null, $options = null)
    {
        $variables['value'] = (!isset($variables['value']))?"":$variables['value'];
        if (isset($variables['value'])) {
            $this->setValue( $variables['value']);
        }

        if (isset($variables['rules'])) {
            $this->setValidation($variables['rules']);
        }

        if (isset($variables['removeable'])) {
            $this->removeable = $variables['removeable'];
        }
        parent::__construct($variables, $options);

    }

    /**
     * Set value
     *
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set validation
     *
     * @param string|array $filter laravel Validation filter
     */
    public function setValidation($filter)
    {
        if(!is_array($filter)){
            $filter = [$filter];
        }
        $this->validationFilter = $filter;
    }

    /**
     * add validation
     *
     * @param string|array $filter laravel Validation filter
     */
    public function addValidation($filter)
    {
        if(!is_array($filter)){
            $filter = [$filter];
        }
        $this->validationFilter = array_merge($filter,$this->validationFilter );
    }

    /**
     * Set validation
     *
     */
    public function getValidation()
    {
        return $this->validationFilter ;
    }

    /**
     * Validate value of element by validation filter using Laravel validator
     *
     * @throws \Exception
     * @return boolean true on success and false on failure
     */
    public function validate()
    {
        $name = $this->getLabel();
        $name = "'".$name."'";
        if ($this->validationFilter) {
            $validator = Validator::make(
                [$name => $this->getValue()],
                [$name => $this->validationFilter]
            );
            if ($validator->fails()) {
                $messages = $validator->messages()->all();
                $str = implode(' - ', $messages);
//                $str = str_replace("*"," ",$str);
                throw new ValidationException($str);
            }
        }

        return true;
    }

    public function render(){
        $this->setVariables(
            [
                'value' => $this->getValue(),
                'removeable' => $this->removeable
            ]
        );
        return parent::render();

    }

    public function fill($data){
//        foreach ($data as $key => $value) {
//            $this->getChildrenByCaptureTo($key)->setVariable('value', $value);
//        }

    }




    /**
     * Get prefix
     * @return string
     */
    public function getPrefix(){
        return $this->getName();
    }

    /**
     * Render
     *
     * @return string
     */
//    public function render($viewPath = '')
//    {
//        $this->setRenderVariable('value', $this->getValue());
//        return parent::render($viewPath, 'element');
//    }


}
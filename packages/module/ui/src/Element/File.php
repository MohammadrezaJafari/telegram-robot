<?php


namespace Module\UI\Element;


use Module\UI\Element;


use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Exception;
use Illuminate\Support\Facades\Validator;
//use Paydar\Form\ValidationException;
use Illuminate\Support\Facades\File as FileLaravel;
use Symfony\Component\HttpFoundation\File\File as FileSymfony;
use Symfony\Component\Yaml\Exception\RuntimeException;

class File extends Element
{
    protected  $objValue;
	/**
     * Constructor
     *
     * @param $name Name
     * @param array $attributes Attributes
     */

    protected $attributes = [];
    public function __construct($name, $attributes = [])
    {
        $this->setTemplate('file');

        $changable= isset($attributes['changeable'])?$attributes['changeable']:true;
        $this->setChangeable($changable);
        $this->value;
        parent::__construct($name, $attributes);
    }

    /**
     * Set changeable atrribute
     * @return void
     * @param bool $value
     */
    public function setChangeable($value){
        if($value){
            $this->attributes['changeable'] = true;
        }else{

            $this->attributes['changeable'] = false;
        }
    }

    /**
     * @return bool
     */
    public function getChangeable(){
        if($this->attributes['changeable'] ){
            return true;
        }
        return false;
    }

    /**
     * Set value
     *
     * @return Uploadfile|string
     * @throws Exception
     * @param $value
     */
    public function setValue($value)
    {
        if(is_null($value) || $value == ''){
            return;
        }
        $destinationPath = public_path().'/uploads/';
        if(is_string($value) ){
            $this->value = $value;
            $this->objValue = new FileSymfony($destinationPath.$value);

        }elseif($value instanceof UploadedFile ) {
            $filename = md5(uniqid().'-'. microtime(true) .'-*-'.$value->getClientOriginalName());
            $extension = $value->getClientOriginalExtension();
            if(strlen($extension)){
                $filename = $filename. '.' . $extension;
            }
            $value->move($destinationPath, $filename);
            $this->value = $filename;
            $this->objValue = $value;
            $this->objValue = new FileSymfony($destinationPath.$filename);
        }else{
            throw new Exception('value is not acceptable');
        }
    }

    /**
     * @return value
     */
    public function getValue()
    {
    	return $this->value;
    }
    
    /**
     * Overrides the parent Render action and sets
     * the Options of select2 in the setRenderVariable action.
     *
     * @param string|array $view
     * @return string
     */
    public function render()
    {
        return parent::render();
    }

    /**
     * Validate value of element by validation filter using Laravel validator
     *
     * @throws \Exception
     * @throws ValidationException
     * @return boolean true on success and false on failure
     */
//    public function validate()
//    {
//        $name = $this->getLabel();
//        $name = "'".$name."'";
//        try{
//
//            $validator = Validator::make(
//                [$name => $this->objValue],
//                [$name => $this->validationFilter]
//            );
//
//            if ($validator->fails()) {
//                $messages = implode(' - ',$validator->messages()->all());
//                if ($this->validationFilter && !is_null($this->objValue)) {
//                    FileLaravel::delete($this->objValue->getPathname());
//                }
//                throw new ValidationException( $messages);
//            }
//
//
//        }catch (\RuntiException $e){
//            throw new ValidationException(dgettext('form','mime type is not valid'));
//        }
//
//        return true;
//    }

}
<?php

namespace common\widgets;

use yii\base\Widget;

class InputField extends Widget {
    
    const PASSWORD = 'password';
    
    const NUMBER = "number";
    
    const TEXT = "text";
    
    const EMAIL = "email";
    
    const HIDDEN = "hidden";
    
    const FIlE = "file";
    
    public $id;
    
    public $name;
    
    public $type;
    
    public $value = '';
    
    public $placeholder = '';
    
    public $timepicker = '';
    
    public $datepicker = false;
    
    public $newClass;
    
    public $disabled = null;

    public $min = null;
    
    public $max = null;
    
    public function init() {
    
    }
    
    public function run() {
        return $this->render('input-field', ['id' => $this->id, 
                                        'name' => $this->name, 
                                        'type' => $this->type, 'newClass' => $this->newClass,
                                        'value' => $this->value, 'min' => $this->min, 'max' => $this->max,
                                        'datepicker' => $this->datepicker,
                                        'disabled' => $this->disabled,
                                        'timepicker'=> $this->timepicker,
                                        'placeholder' => $this->placeholder]);
    }
}
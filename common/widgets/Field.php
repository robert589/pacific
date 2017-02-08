<?php

namespace common\widgets;

use yii\base\Widget;

class Field extends Widget {
    
    const PASSWORD = 'password';
    
    const NUMBER = "number";
    
    const TEXT = "text";
    
    public $id;
    
    public $name;
    
    public $type;
    
    public $value = '';
    
    public $placeholder;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('field', ['id' => $this->id, 
                                        'name' => $this->name, 
                                        'type' => $this->type, 
                                        'value' => $this->value,
                                        'placeholder' => $this->placeholder]);
    }
}
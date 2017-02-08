<?php

namespace common\widgets;

use yii\base\Widget;

class RedactorField extends Widget {
    
    
    public $id;
    
    public $name;
    
    public $value = '';
    
    public $newClass;
    public function init() {
    
    }
    
    public function run() {
        return $this->render('redactor-field', ['id' => $this->id, 
                                        'name' => $this->name, 'newClass' => $this->newClass,
                                        'value' => $this->value]);
    }
}
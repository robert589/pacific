<?php

namespace common\widgets;

use yii\bootstrap\Widget;

class TextAreaField extends Widget {
    
    public $id;
    
    public $rows;
    
    public $name;
    
    public $placeholder;
    
    public $newClass;
    
    public $value = null;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('text-area-field', ['id' => $this->id, 
                                                'rows' => $this->rows, 
                                                'newClass' => $this->newClass,
                                                'value' =>$this->value, 'name' => $this->name,
                                                'placeholder' => $this->placeholder]);
    }
}
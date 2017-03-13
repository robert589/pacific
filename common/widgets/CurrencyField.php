<?php

namespace common\widgets;

use yii\base\Widget;

class CurrencyField extends Widget {
    
    public $id;
    
    public $name;
    
    public $value = '';
    
    public $defaultValue = '';
    
    public $newClass;
    
    public function init() {
    
    }
    
    public function run() {
        return $this->render('currency-field', ['id' => $this->id,
            'name' => $this->name, 'value' => $this->value, 'defaultValue' => $this->defaultValue,
            'newClass' => $this->newClass]);
    }
}
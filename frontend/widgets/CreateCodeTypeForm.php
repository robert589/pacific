<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateCodeTypeForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-code-type-form', ['id' => $this->id]);
    }
}

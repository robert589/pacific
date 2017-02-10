<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateCodeForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-code-form', ['id' => $this->id]);
    }
}

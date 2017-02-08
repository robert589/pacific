<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateOwnerForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-owner-form', ['id' => $this->id]);
    }
}

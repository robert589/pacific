<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateShipForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-ship-form', ['id' => $this->id]);
    }
}

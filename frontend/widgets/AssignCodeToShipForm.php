<?php

namespace frontend\widgets;

use yii\base\Widget;

class AssignCodeToShipForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('assign-code-to-ship-form', ['id' => $this->id]);
    }
}

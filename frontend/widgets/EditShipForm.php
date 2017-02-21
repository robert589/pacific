<?php

namespace frontend\widgets;

use yii\base\Widget;

class EditShipForm extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('edit-ship-form',
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}

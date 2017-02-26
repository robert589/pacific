<?php

namespace frontend\widgets;

use yii\base\Widget;

class EditCodeForm extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('edit-code-form',
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}

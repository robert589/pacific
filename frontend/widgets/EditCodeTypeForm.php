<?php

namespace frontend\widgets;

use yii\base\Widget;

class EditCodeTypeForm extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('edit-code-type-form', 
                ['id' => $this->id, 'vo' => $this->vo   ]);
    }
}

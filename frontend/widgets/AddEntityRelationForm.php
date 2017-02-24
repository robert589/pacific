<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddEntityRelationForm extends Widget {
    
    public $id;
    
    public $code;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-entity-relation-form', 
                ['id' => $this->id, 'code' => $this->code]);
    }
}

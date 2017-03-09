<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddOwnerToCodeForm extends Widget {
    
    public $id;
    
    public $entityId;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-owner-to-code-form', 
                ['id' => $this->id, 'entityId' => $this->entityId]);
    }
}

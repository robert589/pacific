<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddOwnerToCodeFormBtnc extends Widget {
    
    public $id;
    
    public $newClass;
    
    public $entityId;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-owner-to-code-form-btnc', 
                ['id' => $this->id, 
                    'entityId' => $this->entityId,
                    'newClass' => $this->newClass]);
    }
    
}

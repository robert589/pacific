<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddSellingForm extends Widget {
    
    public $id;
    
    public $entityId;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-selling-form', 
                ['id' => $this->id, 'entityId' => $this->entityId, 'date' => $this->date]);
    }
}

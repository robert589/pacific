<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddPurchaseForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-purchase-form', ['id' => $this->id]);
    }
}

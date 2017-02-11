<?php

namespace frontend\widgets;

use yii\base\Widget;

class CustomTransactionForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('custom-transaction-form', ['id' => $this->id]);
    }
}

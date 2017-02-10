<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddTransactionForm extends Widget {
    
    public $id;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-transaction-form',
                ['id' => $this->id, 'date' => $this->date]);
    }
}

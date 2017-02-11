<?php

namespace frontend\widgets;

use yii\base\Widget;

class TransactionItem extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('transaction-item', 
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}

<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailyTransactionItem extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-transaction-item', ['id' => $this->id]);
    }
}

<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailyTransactionView extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-transaction-view', ['id' => $this->id]);
    }
}

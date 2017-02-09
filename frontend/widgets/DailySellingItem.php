<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailySellingItem extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-selling-item', ['id' => $this->id]);
    }
}

<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailyMonitor extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-monitor', ['id' => $this->id]);
    }
}

<?php

namespace frontend\widgets;

use yii\base\Widget;

class ReportItem extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('report-item', 
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}

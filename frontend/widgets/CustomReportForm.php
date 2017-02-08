<?php

namespace frontend\widgets;

use yii\base\Widget;

class CustomReportForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('custom-report-form', ['id' => $this->id]);
    }
}

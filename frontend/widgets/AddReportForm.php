<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddReportForm extends Widget {
    
    public $id;
    
    public $shipId;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-report-form', ['id' => $this->id, 
            'shipId' => $this->shipId, 'date' => $this->date]);
    }
}

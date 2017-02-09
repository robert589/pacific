<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailySellingView extends Widget {
    

    public $id;
    
    public $vos;
    
    public $date;
    
    public $shipId;

    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-selling-view', 
                ['id' => $this->id, 'vos' => $this->vos,
                    'date' => $this->date, 'shipId' => $this->shipId]);
    }
}

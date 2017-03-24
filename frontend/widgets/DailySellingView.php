<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\libraries\Currency;

class DailySellingView extends Widget {
    

    public $id;
    
    public $provider;
    
    public $date;
    
    public $totalSaldo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-selling-view', 
                ['id' => $this->id, 
                    'provider' => $this->provider,
                    'totalSaldo' => $this->totalSaldo,
                    'date' => $this->date]);
    }
}

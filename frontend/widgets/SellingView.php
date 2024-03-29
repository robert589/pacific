<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\libraries\Currency;

class SellingView extends Widget {
    
    public $id;
    
    public $provider;
    
    public $currentSaldo;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('selling-view',
                ['id' => $this->id, 'provider' => $this->provider]);
        
    }
    
    
    private function countDailySaldo() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getTotal());
            }
        }
        
        return $total;

    }
    
}

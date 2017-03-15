<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\libraries\Currency;

class DailySellingView extends Widget {
    

    public $id;
    
    public $vos;
    
    public $date;
    
    public $entityId;

    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-selling-view', 
                ['id' => $this->id, 'vos' => $this->vos,
                    'dailySaldo' => Currency::parse($this->countDailySaldo()),
                    'date' => $this->date, 'entityId' => $this->entityId]);
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

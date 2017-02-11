<?php

namespace frontend\widgets;

use yii\base\Widget;

class SellingView extends Widget {
    
    public $id;
    
    public $vos;
    
    public $currentSaldo;
    
    public $shipId;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('selling-view',
                ['id' => $this->id, 'vos' => $this->vos,
                    'dailySaldo' => $this->countDailySaldo(),
                    'shipId' => $this->shipId,
                    'date' => $this->date,
                    'currentSaldo' => $this->currentSaldo]);
        
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
<?php

namespace frontend\widgets;

use yii\base\Widget;

class ReportView extends Widget {
    
    public $id;
    
    public $vos;
    
    public $currentSaldo;
    
    public $saldoAtPoint;
    
    public $shipId;
    
    public $date;
    
    public function init() {
        
    }
    
    
    public function run() {
        return $this->render('report-view', 
                ['id' => $this->id, 'vos' => $this->vos,
                    'shipId'=> $this->shipId, 'date' => $this->date,
                    'dailySaldo' => $this->countDailySaldo(),
                    'currentSaldo' => $this->currentSaldo]);
    }   
    
    
    private function countDailySaldo() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getSaldo());
            }
        }
        
        return $total;
    }
}

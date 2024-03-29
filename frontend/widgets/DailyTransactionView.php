<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailyTransactionView extends Widget {
    
    public $id;
    
    public $vos;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-transaction-view', 
                ['id' => $this->id, 'vos' => $this->vos, 
                    'dailySaldo' => $this->countDailySaldo(),
                    'totalDebet' => $this->countDailyDebet(),
                    'totalCredit' => $this->countDailyCredit(),
                    'date' => $this->date]);
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
    
    private function countDailyDebet() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getDebet());
            }
        }
        
        return $total;
    }
    
    private function countDailyCredit() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getCredit());
            }
        }
        
        return $total;
    }
}

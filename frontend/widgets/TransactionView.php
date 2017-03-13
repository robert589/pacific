<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\libraries\Currency;

class TransactionView extends Widget {
    
    public $id;
    
    public $vos;
    
    public $entityVo;
    
    public $date;
    
    public $from;
    
    public $to;
    
    public $initialSaldo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('transaction-view', 
                ['id' => $this->id, 'totalSaldo' => Currency::parse($this->countSaldo()),
                    'totalDebet' => Currency::parse($this->countDebet()),
                    'totalCredit' => Currency::parse($this->countCredit()),
                    'initialSaldo' => Currency::parse($this->initialSaldo),
                    'entityVo' => $this->entityVo,
                    'from' => $this->from,
                    'to' => $this->to,
                    'vos' => $this->vos, 'date' => $this->date ]);
    }
    
    /**
     * 
     * @return string
     */
    private function countSaldo() {
        
        $total = floatval($this->initialSaldo) + floatval($this->countDebet())
                - floatval($this->countCredit());
        return $total;
    }

    /**
     * 
     * @return string
     */
    private function countDebet() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getDebet());
            }
        }
        
        return $total;
    }
    
    /**
     * 
     * @return string
     */
    private function countCredit() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getCredit());
            }
        }
        
        return $total;
    }
}

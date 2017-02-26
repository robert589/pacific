<?php

namespace frontend\widgets;

use yii\base\Widget;

class TransactionView extends Widget {
    
    public $id;
    
    public $vos;
    
    public $entityVo;
    
    public $date;
    
    public $from;
    
    public $to;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('transaction-view', 
                ['id' => $this->id, 'totalSaldo' => $this->countSaldo(),
                    'entityVo' => $this->entityVo,
                    'from' => $this->from,
                    'to' => $this->to,
                    'vos' => $this->vos, 'date' => $this->date ]);
    }
    
    private function countSaldo() {
        $total = 0;
        if(is_array($this->vos) && count($this->vos) > 0) {
            foreach($this->vos as $vo) {
                $total += floatVal($vo->getSaldo());
            }
        }
        
        return $total;
    }

}

<?php

namespace frontend\widgets;

use yii\base\Widget;

class DailyReportView extends Widget {
    
    public $id;
    
    public $vos;
    
    public $currentSaldo;
    
    public $saldoAtPoint;
    
    public $shipId;
    
    public $date;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('daily-report-view', 
                ['id' => $this->id, 'vos' => $this->vos,
                    'shipId'=> $this->shipId, 'date' => $this->date,
                    'dailySaldo' => $this->countDailySaldo(),
                    'previousSaldo' => $this->previousSaldo(),
                    'currentSaldo' => $this->currentSaldo,
                    'saldoAtPoint' => $this->saldoAtPoint]);
    }   
    
    private function previousSaldo() {
        $dailySaldo = $this->countDailySaldo();

        return floatval($this->saldoAtPoint) - floatval($dailySaldo);
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
    
    private function generateDailySaldoEl($saldo) {
        if($saldo >= 0) {
            return '<span class="dr-view-daily-saldo" style="color:green">'. $saldo  . '</span>';
        } else {
            return '<span class="dr-view-daily-saldo" style="color:red">'. $saldo  . '</span>';
        }
    }
}

<?php

namespace frontend\widgets;

use yii\base\Widget;

class TransactionItem extends Widget {
    
    public $id;
    
    public $vo;
    
    public $showSaldo;
    
    public $showDebet;
    
    public $showCredit;
    
    public $showRemark;
    
    public $showDate;
    
    public $showCode;


    public function init() {
        
    }
    
    public function run() {
        return $this->render('transaction-item', 
                ['id' => $this->id, 
                'vo' => $this->vo,
                'showDate' => $this->showDate,
                'showCode' => $this->showCode,
                'showCredit' => $this->showCredit,
                'showDebet' => $this->showDebet,
                'showSaldo' => $this->showSaldo,
                'showRemark' => $this->showRemark]);
    }
}

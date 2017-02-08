<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * ReportVo vo
 *
 */
class ReportVo implements RVo
{
    public static function createBuilder() { return new ReportVoBuilder();} 
    //attributes

    private $id;

    private $date;

    private $shipId;

    private $remark;

    private $debet;

    private $credit;

    private $status;

    private $highlight;

    public function __construct(ReportVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->date = $builder->getDate(); 
        $this->shipId = $builder->getShipId(); 
        $this->remark = $builder->getRemark(); 
        $this->debet = $builder->getDebet(); 
        $this->credit = $builder->getCredit(); 
        $this->status = $builder->getStatus(); 
        $this->highlight = $builder->getHighlight(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getDate() { 
        return $this->date; 
    }

    public function getShipId() { 
        return $this->shipId; 
    }

    public function getRemark() { 
        return $this->remark; 
    }

    public function getDebet() { 
        return $this->debet; 
    }

    public function getCredit() { 
        return $this->credit; 
    }
    
    public function getSaldo() {
        return floatval($this->debet) - floatval($this->credit);
    }
    public function getSaldoElement() {
        $saldo = $this->getSaldo();
        if($saldo >= 0) {
            return "<span style='color:green'>$saldo</span>";
        } else {
            return "<span style='color:red'>$saldo</span>";
        }
    }
    public function getStatus() { 
        return $this->status; 
    }

    public function getHighlight() { 
        return $this->highlight; 
    }
}
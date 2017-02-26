<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * TransactionVo vo
 *
 */
class TransactionVo implements RVo
{
    public static function createBuilder() { return new TransactionVoBuilder();} 
    //attributes

    private $id;

    private $date;

    private $entity;

    private $debet;

    private $credit;

    private $remark;

    private $status;

    private $createdAt;

    private $updatedAt;

    public function __construct(TransactionVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->date = $builder->getDate(); 
        $this->entity = $builder->getEntity(); 
        $this->debet = $builder->getDebet(); 
        $this->credit = $builder->getCredit(); 
        $this->remark = $builder->getRemark(); 
        $this->status = $builder->getStatus(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getDate() { 
        return $this->date; 
    }

    public function getEntity() { 
        return $this->entity; 
    }

    public function getDebet() { 
        return $this->debet; 
    }

    public function getCredit() { 
        return $this->credit; 
    }

    public function getRemark() { 
        return $this->remark; 
    }

    public function getStatus() { 
        return $this->status; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
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

}
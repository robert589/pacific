<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * TransactionVo builder
 *
 */
class TransactionVoBuilder extends RVoBuilder
{
    function build() { return new TransactionVo($this);  }
    //attributes

    public $id;

    public $date;

    public $entity;

    public $debet;

    public $credit;

    public $remark;

    public $status;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['id','string'],
           ['date','string'],
           ['entity','string'],
           ['debet','string'],
           ['credit','string'],
           ['remark','string'],
           ['status','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setDate($date) { 
        $this->date = $date; 
    }

    public function setEntity($entity) { 
        $this->entity = $entity; 
    }

    public function setDebet($debet) { 
        $this->debet = $debet; 
    }

    public function setCredit($credit) { 
        $this->credit = $credit; 
    }

    public function setRemark($remark) { 
        $this->remark = $remark; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}
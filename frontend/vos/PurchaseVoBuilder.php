<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * PurchaseVo builder
 *
 */
class PurchaseVoBuilder extends RVoBuilder
{
    function build() { return new PurchaseVo($this);  }
    //attributes

    public $id;

    public $entity;

    public $quantity;

    public $unitCost;

    public $expiryDate;

    public $createdAt;

    public $updatedAt;

    public $createdBy;

    public $updatedBy;

    public $status;

    public $date;

    public function rules() { 
        return [
           ['id','string'],
           ['entity','string'],
           ['quantity','string'],
           ['unitCost','string'],
           ['expiryDate','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['createdBy','string'],
           ['updatedBy','string'],
           ['status','string'],
           ['date','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getEntity() { 
        return $this->entity; 
    }

    public function getQuantity() { 
        return $this->quantity; 
    }

    public function getUnitCost() { 
        return $this->unitCost; 
    }

    public function getExpiryDate() { 
        return $this->expiryDate; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getCreatedBy() { 
        return $this->createdBy; 
    }

    public function getUpdatedBy() { 
        return $this->updatedBy; 
    }

    public function getStatus() { 
        return $this->status; 
    }

    public function getDate() { 
        return $this->date; 
    }

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setEntity($entity) { 
        $this->entity = $entity; 
    }

    public function setQuantity($quantity) { 
        $this->quantity = $quantity; 
    }

    public function setUnitCost($unitCost) { 
        $this->unitCost = $unitCost; 
    }

    public function setExpiryDate($expiryDate) { 
        $this->expiryDate = $expiryDate; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setCreatedBy($createdBy) { 
        $this->createdBy = $createdBy; 
    }

    public function setUpdatedBy($updatedBy) { 
        $this->updatedBy = $updatedBy; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setDate($date) { 
        $this->date = $date; 
    }
}
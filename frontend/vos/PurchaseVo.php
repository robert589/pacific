<?php
namespace frontend\vos;

use common\models\Purchase;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * PurchaseVo vo
 *
 */
class PurchaseVo implements RVo
{
    public static function createBuilder() { return new PurchaseVoBuilder();} 
    //attributes

    private $id;

    private $entity;

    private $quantity;

    private $unitCost;

    private $expiryDate;

    private $createdAt;

    private $updatedAt;

    private $createdBy;

    private $updatedBy;

    private $status;

    private $date;

    public function __construct(PurchaseVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->entity = $builder->getEntity(); 
        $this->quantity = $builder->getQuantity(); 
        $this->unitCost = $builder->getUnitCost(); 
        $this->expiryDate = $builder->getExpiryDate(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->createdBy = $builder->getCreatedBy(); 
        $this->updatedBy = $builder->getUpdatedBy(); 
        $this->status = $builder->getStatus(); 
        $this->date = $builder->getDate(); 
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
    
    public function getStatusText() {
        return Purchase::getStatus()[$this->status];
    }
    
    public function isActive() {
        return intval($this->status) === intval(Purchase::STATUS_ACTIVE);
    }
     
    public function getDate() { 
        return $this->date; 
    }
}
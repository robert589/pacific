<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * InventoryVo vo
 *
 */
class InventoryVo implements RVo
{
    public static function createBuilder() { return new InventoryVoBuilder();} 
    //attributes

    private $id;

    private $entity;

    private $quantity;

    private $fixedAsset;

    private $type;

    private $createdAt;

    private $updatedAt;

    private $warehouse;

    private $status;

    public function __construct(InventoryVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->entity = $builder->getEntity(); 
        $this->quantity = $builder->getQuantity(); 
        $this->fixedAsset = $builder->getFixedAsset(); 
        $this->type = $builder->getType(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->warehouse = $builder->getWarehouse(); 
        $this->status = $builder->getStatus(); 
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

    public function getFixedAsset() { 
        return $this->fixedAsset; 
    }

    public function getType() { 
        return $this->type; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getWarehouse() { 
        return $this->warehouse; 
    }

    public function getStatus() { 
        return $this->status; 
    }
}
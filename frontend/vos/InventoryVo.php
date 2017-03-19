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

    private $status;

    private $createdAt;

    private $updatedAt;

    public function __construct(InventoryVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->entity = $builder->getEntity(); 
        $this->quantity = $builder->getQuantity(); 
        $this->fixedAsset = $builder->getFixedAsset(); 
        $this->type = $builder->getType(); 
        $this->status = $builder->getStatus(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
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

    public function getStatus() { 
        return $this->status; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
}
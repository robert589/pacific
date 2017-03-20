<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * InventoryVo builder
 *
 */
class InventoryVoBuilder extends RVoBuilder
{
    function build() { return new InventoryVo($this);  }
    //attributes

    public $id;

    public $entity;

    public $quantity;

    public $fixedAsset;

    public $type;

    public $createdAt;

    public $updatedAt;

    public $warehouse;

    public $status;

    public function rules() { 
        return [
           ['id','string'],
           ['entity','string'],
           ['quantity','string'],
           ['fixedAsset','string'],
           ['type','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['warehouse','string'],
           ['status','string'],
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

    public function setFixedAsset($fixedAsset) { 
        $this->fixedAsset = $fixedAsset; 
    }

    public function setType($type) { 
        $this->type = $type; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setWarehouse($warehouse) { 
        $this->warehouse = $warehouse; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }
}
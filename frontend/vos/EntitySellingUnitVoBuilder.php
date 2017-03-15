<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * EntitySellingUnitVo builder
 *
 */
class EntitySellingUnitVoBuilder extends RVoBuilder
{
    function build() { return new EntitySellingUnitVo($this);  }
    //attributes

    public $entityId;

    public $unit;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['entityId','string'],
           ['unit','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
    }

    //getters

    public function getEntityId() { 
        return $this->entityId; 
    }

    public function getUnit() { 
        return $this->unit; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    //setters

    public function setEntityId($entityId) { 
        $this->entityId = $entityId; 
    }

    public function setUnit($unit) { 
        $this->unit = $unit; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}
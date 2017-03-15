<?php
namespace frontend\vos;

use frontend\constants\SellingConstants;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * EntitySellingUnitVo vo
 *
 */
class EntitySellingUnitVo implements RVo
{
    public static function createBuilder() { return new EntitySellingUnitVoBuilder();} 
    //attributes

    private $entityId;

    private $unit;

    private $createdAt;

    private $updatedAt;

    public function __construct(EntitySellingUnitVoBuilder $builder) { 
        $this->entityId = $builder->getEntityId(); 
        $this->unit = $builder->getUnit(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getEntityId() { 
        return $this->entityId; 
    }

    public function getUnit() { 
        if(!$this->unit) {
            return SellingConstants::DEFAULT_UNIT;
        }
        return $this->unit; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
}
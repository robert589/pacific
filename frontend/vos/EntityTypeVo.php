<?php
namespace frontend\vos;

use common\models\EntityType;
use yii\db\ActiveRecord;
use common\components\RVo;

/**
 * EntityTypeVo vo
 *
 */
class EntityTypeVo implements RVo
{
    public static function createBuilder() { return new EntityTypeVoBuilder();} 
    //attributes

    private $id;

    private $name;

    private $description;

    private $status;

    private $createdAt;

    private $updatedAt;

    public function __construct(EntityTypeVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->description = $builder->getDescription(); 
        $this->status = $builder->getStatus(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getDescription() { 
        return $this->description; 
    }

    public function getStatus() { 
        return $this->status; 
    }
    
    public function getStatusText() {
        return EntityType::getStatus()[$this->status];
    }
    
    public function isActive() {
        return intval($this->status) === intval(EntityType::STATUS_ACTIVE);
    }
    
    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
}
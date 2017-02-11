<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * EntityVo vo
 *
 */
class EntityVo implements RVo
{
    public static function createBuilder() { return new EntityVoBuilder();} 
    //attributes

    private $id;

    private $name;

    private $description;

    private $status;

    private $entityType;

    private $createdAt;

    private $updatedAt;

    public function __construct(EntityVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->description = $builder->getDescription(); 
        $this->status = $builder->getStatus(); 
        $this->entityType = $builder->getEntityType(); 
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

    public function getEntityType() { 
        return $this->entityType; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
}
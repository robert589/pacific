<?php
namespace frontend\vos;

use common\models\Role;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * RoleVo vo
 *
 */
class RoleVo implements RVo
{
    public static function createBuilder() { return new RoleVoBuilder();} 
    //attributes

    private $id;

    private $name;

    private $description;

    private $status;

    private $createdAt;

    private $updatedAt;
    
    private $rights;
    
    public function __construct(RoleVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->description = $builder->getDescription(); 
        $this->status = $builder->getStatus(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->rights = $builder->getRights();
        
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

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
    
    public function getRights() {
        return $this->rights;
    }
    
    public function getStatusText() {
        return Role::getStatus()[$this->status];
    }
    
    public function isActive() {
        return intval(Role::STATUS_ACTIVE) === intval($this->status);
    }
}
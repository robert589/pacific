<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * AccessControlVo vo
 *
 */
class AccessControlVo implements RVo
{
    public static function createBuilder() { return new AccessControlVoBuilder();} 
    //attributes

    private $id;

    private $code;

    private $name;

    private $description;

    private $status;

    private $createdAt;

    private $updatedAt;

    public function __construct(AccessControlVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->code = $builder->getCode(); 
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

    public function getCode() { 
        return $this->code; 
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
}
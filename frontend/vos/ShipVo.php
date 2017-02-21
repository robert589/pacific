<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * ShipVo vo
 *
 */
class ShipVo implements RVo
{
    public static function createBuilder() { return new ShipVoBuilder();} 
    //attributes

    private $id;

    private $name;

    private $description;

    private $owners;

    private $status;

    public function __construct(ShipVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->description = $builder->getDescription(); 
        $this->owners = $builder->getOwners(); 
        $this->status = $builder->getStatus(); 
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

    public function getOwners() { 
        return $this->owners; 
    }

    public function getStatus() { 
        return $this->status; 
    }
}
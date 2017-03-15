<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * EntityVo builder
 *
 */
class EntityVoBuilder extends RVoBuilder
{
    function build() { return new EntityVo($this);  }
    //attributes

    public $id;

    public $name;

    public $childEntities;
    
    public $description;

    public $status;

    public $entityType;

    public $createdAt;
    
    public $code;
    
    public $entitySellingUnitVo;
    
    public $updatedAt;

    public function rules() { 
        return [
           ['id','string'],
           ['name','string'],
           ['description','string'],
           ['status','string'],
            ['code', 'string'],
           ['entityType','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setDescription($description) { 
        $this->description = $description; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setEntityType($entityType) { 
        $this->entityType = $entityType; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
    
    function getChildEntities() {
        return $this->childEntities;
    }

    function setChildEntities($childEntities) {
        $this->childEntities = $childEntities;
    }
    
    function getCode() {
        return $this->code;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function getEntitySellingUnitVo() {
        return $this->entitySellingUnitVo;
    }

    function setEntitySellingUnitVo($entitySellingUnitVo) {
        $this->entitySellingUnitVo = $entitySellingUnitVo;
    }




}
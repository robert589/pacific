<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * WarehouseVo builder
 *
 */
class WarehouseVoBuilder extends RVoBuilder
{
    function build() { return new WarehouseVo($this);  }
    //attributes

    public $entity;

    public $location;

    public $createdAt;
    
    public $sellingPlace;

    public $updatedAt;

    public function rules() { 
        return [
           ['entity','string'],
           ['location','string'],
           ['createdAt','string'],
            ['sellingPlace', 'string'],
           ['updatedAt','string'],
        ];
    }

    //getters

    public function getEntity() { 
        return $this->entity; 
    }

    public function getLocation() { 
        return $this->location; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    //setters

    public function setEntity($entity) { 
        $this->entity = $entity; 
    }

    public function setLocation($location) { 
        $this->location = $location; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
    
    function getSellingPlace() {
        return $this->sellingPlace;
    }

    function setSellingPlace($sellingPlace) {
        $this->sellingPlace = $sellingPlace;
    }


}
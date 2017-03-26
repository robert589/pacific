<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * AssetVo builder
 *
 */
class AssetVoBuilder extends RVoBuilder
{
    function build() { return new AssetVo($this);  }
    //attributes

    public $entity;

    public $method;

    public $createdAt;
    
    public $fixedAsset;
    
    public $total;
    
    public $updatedAt;

    public function rules() { 
        return [
           ['entity','string'],
           ['method','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
            ['total', 'string'],
           ['fixedAsset', 'string']
        ];
    }

    //getters

    public function getEntity() { 
        return $this->entity; 
    }

    public function getMethod() { 
        return $this->method; 
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

    public function setMethod($method) { 
        $this->method = $method; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
    
    function isFixedAsset() {
        return $this->fixedAsset;
    }

    function getTotal() {
        return $this->total;
    }

    function setFixedAsset($fixedAsset) {
        $this->fixedAsset = $fixedAsset;
    }

    function setTotal($total) {
        $this->total = $total;
    }


}
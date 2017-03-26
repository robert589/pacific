<?php
namespace frontend\vos;

use common\models\Asset;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * AssetVo vo
 *
 */
class AssetVo implements RVo
{
    public static function createBuilder() { return new AssetVoBuilder();} 
    //attributes

    private $entity;

    private $method;
    
    private $fixedAsset;
    
    private $total;
    
    private $createdAt;

    private $updatedAt;

    public function __construct(AssetVoBuilder $builder) { 
        $this->entity = $builder->getEntity(); 
        $this->method = $builder->getMethod(); 
        $this->total = $builder->getTotal();
        $this->fixedAsset = $builder->isFixedAsset();
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getEntity() { 
        return $this->entity; 
    }

    public function getMethod() { 
        return Asset::getTypes()[$this->method]; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
    
    public function getTotal() {
        return $this->total;
    }
    
    public function isFixedAsset() {
        return $this->fixedAsset;
    }
}
<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * WarehouseVo vo
 *
 */
class WarehouseVo implements RVo
{
    public static function createBuilder() { return new WarehouseVoBuilder();} 
    //attributes

    private $entity;

    private $location;

    private $sellingPlace;
    
    private $createdAt;

    private $updatedAt;

    public function __construct(WarehouseVoBuilder $builder) { 
        $this->entity = $builder->getEntity(); 
        $this->location = $builder->getLocation(); 
        $this->createdAt = $builder->getCreatedAt();
        $this->sellingPlace = $builder->getSellingPlace();
        $this->updatedAt = $builder->getUpdatedAt(); 
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
    
    /**     
     * 
     * @return int
     */
    public function isSellingPlace() {
        return boolval($this->sellingPlace) ? 1 : 0;
    }
}
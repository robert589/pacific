<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
use common\libraries\Currency;
/**
 * SellingVo vo
 *
 */
class SellingVo implements RVo
{
    public static function createBuilder() { return new SellingVoBuilder();} 
    //attributes

    private $id;

    private $entity;

    private $entityId;

    private $date;

    private $price;

    private $tonase;

    private $total;

    private $createdAt;

    private $updatedAt;

    private $status;

    private $remark;

    public function __construct(SellingVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->entity = $builder->getEntity(); 
        $this->entityId = $builder->getEntityId(); 
        $this->date = $builder->getDate(); 
        $this->price = $builder->getPrice(); 
        $this->tonase = $builder->getTonase(); 
        $this->total = $builder->getTotal(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->status = $builder->getStatus(); 
        $this->remark = $builder->getRemark(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getEntity() { 
        return $this->entity; 
    }

    public function getEntityId() { 
        return $this->entityId; 
    }

    public function getDate() { 
        return $this->date; 
    }

    public function getPrice() { 
        return $this->price; 
    }
    
    public function getPriceInCurrency() {
        return Currency::parse($this->price);
    }
    
    public function getTonase() { 
        return $this->tonase; 
    }
    
    public function getTotal() { 
        return ($this->total) ? $this->total : (floatval($this->tonase) * floatval($this->price)); 
    }
    
    public function getTotalInCurrency() {
        return Currency::parse($this->getTotal());
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getStatus() { 
        return $this->status; 
    }

    public function getRemark() { 
        return $this->remark; 
    }
}
<?php
namespace frontend\vos;

use common\libraries\Currency;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * SellingVo vo
 *
 */
class SellingVo implements RVo
{
    public static function createBuilder() { return new SellingVoBuilder();} 
    //attributes

    private $id;
    
    private $product;

    private $buyer;

    private $date;

    private $price;

    private $unit;

    private $createdAt;

    private $updatedAt;

    private $status;

    private $remark;

    private $warehouse;

    public function __construct(SellingVoBuilder $builder) { 
        $this->product = $builder->getProduct(); 
        $this->buyer = $builder->getBuyer(); 
        $this->date = $builder->getDate(); 
        $this->price = $builder->getPrice(); 
        $this->unit = $builder->getUnit(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->status = $builder->getStatus(); 
        $this->remark = $builder->getRemark(); 
        $this->warehouse = $builder->getWarehouse(); 
        $this->id = $builder->getId();
    }

    //getters
    
    public function getId() {
        return $this->id;
    }

    public function getProduct() { 
        return $this->product; 
    }

    public function getBuyer() { 
        return $this->buyer; 
    }

    public function getDate() { 
        return $this->date; 
    }

    public function getPrice() { 
        return $this->price; 
    }
    
    public function getPriceView() {
        return Currency::parse($this->getPrice());
    }
    
    public function getTotal() {
        return doubleval($this->price) * doubleval($this->unit);
    }

    public function getUnit() { 
        return $this->unit; 
    }
    
    public function getTotalView() {
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

    public function getWarehouse() { 
        return $this->warehouse; 
    }
}
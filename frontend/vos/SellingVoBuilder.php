<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * SellingVo builder
 *
 */
class SellingVoBuilder extends RVoBuilder
{
    function build() { return new SellingVo($this);  }
    //attributes

    public $product;

    public $buyer;

    public $date;

    public $price;

    public $unit;

    public $createdAt;

    public $updatedAt;

    public $status;

    public $remark;

    public $warehouse;

    public function rules() { 
        return [
           ['product','string'],
           ['buyer','string'],
           ['date','string'],
           ['price','string'],
           ['unit','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['status','string'],
           ['remark','string'],
           ['warehouse','string'],
        ];
    }

    //getters

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

    public function getUnit() { 
        return $this->unit; 
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

    //setters

    public function setProduct($product) { 
        $this->product = $product; 
    }

    public function setBuyer($buyer) { 
        $this->buyer = $buyer; 
    }

    public function setDate($date) { 
        $this->date = $date; 
    }

    public function setPrice($price) { 
        $this->price = $price; 
    }

    public function setUnit($unit) { 
        $this->unit = $unit; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setRemark($remark) { 
        $this->remark = $remark; 
    }

    public function setWarehouse($warehouse) { 
        $this->warehouse = $warehouse; 
    }
}
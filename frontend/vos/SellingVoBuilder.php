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

    public $id;

    public $ship;

    public $shipId;

    public $date;

    public $price;

    public $tonase;

    public $total;

    public $createdAt;

    public $updatedAt;

    public $status;

    public $remark;

    public function rules() { 
        return [
           ['id','string'],
           ['ship','string'],
           ['shipId','string'],
           ['date','string'],
           ['price','string'],
           ['tonase','string'],
           ['total','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['status','string'],
           ['remark','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getShip() { 
        return $this->ship; 
    }

    public function getShipId() { 
        return $this->shipId; 
    }

    public function getDate() { 
        return $this->date; 
    }

    public function getPrice() { 
        return $this->price; 
    }

    public function getTonase() { 
        return $this->tonase; 
    }

    public function getTotal() { 
        return $this->total; 
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setShip($ship) { 
        $this->ship = $ship; 
    }

    public function setShipId($shipId) { 
        $this->shipId = $shipId; 
    }

    public function setDate($date) { 
        $this->date = $date; 
    }

    public function setPrice($price) { 
        $this->price = $price; 
    }

    public function setTonase($tonase) { 
        $this->tonase = $tonase; 
    }

    public function setTotal($total) { 
        $this->total = $total; 
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
}
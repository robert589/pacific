<?php

namespace frontend\vos;

use frontend\vos\EntityVo;
use yii\db\ActiveRecord;
use common\components\RVoBuilder;

/**
 * SellingVo builder
 *
 */
class SellingVoBuilder extends RVoBuilder {

    function build() {
        return new SellingVo($this);
    }

    //attributes

    public $id;

    /**
     *
     * @var EntityVo
     */
    public $product;
    public $productId;

    /**
     *
     * @var EntityVo
     */
    public $buyer;
    public $buyerId;
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
            ['id', 'string'],
            ['product', 'string'],
            ['productId', 'string'],
            ['buyer', 'string'],
            ['buyerId', 'string'],
            ['date', 'string'],
            ['price', 'string'],
            ['tonase', 'string'],
            ['total', 'string'],
            ['createdAt', 'string'],
            ['updatedAt', 'string'],
            ['status', 'string'],
            ['remark', 'string'],
        ];
    }

    //getters

    public function getId() {
        return $this->id;
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

    function getProduct() {
        return $this->product;
    }

    function getProductId() {
        return $this->productId;
    }

    function getBuyer() {
        return $this->buyer;
    }

    function getBuyerId() {
        return $this->buyerId;
    }

    function setProduct(EntityVo $product) {
        $this->product = $product;
    }

    function setProductId($productId) {
        $this->productId = $productId;
    }

    function setBuyer(EntityVo $buyer) {
        $this->buyer = $buyer;
    }

    function setBuyerId($buyerId) {
        $this->buyerId = $buyerId;
    }


}

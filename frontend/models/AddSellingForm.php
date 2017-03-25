<?php
namespace frontend\models;

use common\validators\InInventoryValidator;
use common\models\Selling;
use common\components\RModel;
use common\models\Inventory;
use common\models\Entity;
use common\validators\DateValidator;
use frontend\daos\SellingDao;

/**
 * AddSellingForm model
 *
 */
class AddSellingForm extends RModel
{

    //attributes
    public $user_id;

    public $date;

    public $remark;

    public $unit;

    public $price;

    public $product_id;
    
    public $buyer_id;
    
    public $warehouse_id;
    
    private $sellingDao;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['date', 'string' ],
            ['date', DateValidator::className()],
            ['date', 'required'],
            
            ['remark','string'],
            
            ['product_id', 'integer'],
            ['product_id', 'required'],
            
            ['buyer_id', 'integer'],
            
            ['warehouse_id', 'integer'],
            ['warehouse_id', 'required', 'when' => function ($model) {
                return Entity::inInventory($model->product_id);
            }
            ],
            ['unit', 'double'],
            ['unit', 'required'],
            
            ['price', 'double'],
            ['price', 'required'],
        ];
    }
    
    public function init() {
        $this->sellingDao = new SellingDao();
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $selling = new Selling();
        $selling->remark = $this->remark;
        $selling->date = $this->date;
        $selling->product_id = $this->product_id;
        $selling->buyer_id = $this->buyer_id;
        $selling->status = Selling::STATUS_ACTIVE;
        $selling->price = $this->price;
        $selling->unit   = $this->unit;
        $selling->warehouse_id = $this->warehouse_id;
        
        if(!$selling->save()) {
            return false;
        }
        
        Inventory::remove($this->product_id, $this->warehouse_id, $this->unit);
        return true;
    }
}
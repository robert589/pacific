<?php
namespace frontend\models;

use common\models\Selling;
use common\components\RModel;
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

    public $total;

    public $tonase;

    public $price;

    public $product_id;
    
    public $buyer_id;
    
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
            
            ['total', 'double'],
            ['tonase', 'double'],
            ['price', 'double'],
            ['total', 'validateFields']
        ];
    }
    
    public function validateFields() {
        if($this->total <= 0.0000000001) {
            if($this->price <= 0.0000000001 || $this->tonase <= 0.00000000001) {
                $this->addError('total', 'Wajib diisi');
                $this->addError('tonase', 'Wajib diisi');
                $this->addError('price  ', 'Wajib diisi');

            }
        }
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
        if(!$this->total || $this->total <= 0.00000000001) {
           $selling->price = $this->price;
           $selling->tonase = $this->tonase;
        } else {
            $selling->total = $this->total;
        }
        
        if(!$selling->save()) {
            return NULL;
        }
        
        return $this->sellingDao->getSellingInfo($selling->id);
    }
}
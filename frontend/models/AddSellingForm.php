<?php
namespace frontend\models;

use common\models\Selling;
use common\components\RModel;
use common\validators\DateValidator;

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

    public $entity_id;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['date', 'string' ],
            ['date', DateValidator::className()],
            ['date', 'required'],
            
            ['remark','string'],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required'],
            
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
    
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $selling = new Selling();
        $selling->remark = $this->remark;
        $selling->date = $this->date;
        $selling->entity_id = $this->entity_id;
        $selling->status = Selling::STATUS_ACTIVE;
        if(!$this->total || $this->total <= 0.00000000001) {
           $selling->price = $this->price;
           $selling->tonase = $this->tonase;
        } else {
            $selling->total = $this->total;
        }
        
        return ($selling->save()) ? $selling : NULL;
    }
}
<?php
namespace frontend\models;

use common\models\Purchase;
use common\components\RModel;
/**
 * ChangePurchaseStatusForm model
 *
 */
class ChangePurchaseStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $purchase_id;

    public $status;
    
    private $purchase;
    
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['purchase_id' , 'integer'],
            ['purchase_id', 'required'],
            ['purchase_id', 'checkExist'],
            
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function checkExist() {
        $this->purchase = Purchase::find()->where(['id' => $this->purchase_id])->one();
        if(!$this->purchase) {
            return $this->addError('purchase_id', 'Purchase does not exist');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        if($this->purchase->status == $this->status) {
            return false;
        }
        
        
        $this->purchase->status = $this->status;
        
        return $this->purchase->update();
        
    }

}
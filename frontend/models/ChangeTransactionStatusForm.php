<?php
namespace frontend\models;

use common\validators\IsAdminValidator;
use common\models\Transaction;
use common\components\RModel;
/**
 * ChangeTransactionStatusForm model
 *
 */
class ChangeTransactionStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $transaction_id;

    public $status;

    private $transaction;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['transaction_id' , 'integer'],
            ['transaction_id', 'required'],
            ['transaction_id', 'checkExist'],
            
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function checkExist() {
        $this->transaction = Transaction::find()->where(['id' => $this->transaction_id])->one();
        if(!$this->transaction) {
            return $this->addError('transaction_id', 'Transaction does not exist');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        if($this->transaction->status != $this->status) {
            $this->transaction->status = $this->status;
            return $this->transaction->update();
        }
        return true;
    }


}
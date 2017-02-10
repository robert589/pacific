<?php
namespace frontend\models;

use common\validators\DateValidator;
use common\components\RModel;
use common\validators\IsAdminValidator;
use common\models\Transaction;
/**
 * AddTransactionForm model
 *
 */
class AddTransactionForm extends RModel
{

    //attributes
    public $user_id;

    public $date;

    public $entity_id;

    public $remark;

    public $debet;

    public $credit;

    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required'],
            
            ['remark', 'string'],
            ['remark', 'required'],
            
            ['debet', 'double'],
            ['debet', 'required'],
            
            ['credit', 'double'],
            ['credit', 'required'],
            
            ['date', 'string'],
            ['date', DateValidator::className()],
            ['date', 'required']
        ];
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = new Transaction();
        $model->entity_id = $this->entity_id;
        $model->date = $this->date;
        $model->debet = $this->debet;
        $model->credit = $this->credit;
        $model->remark = $this->remark;
        $model->status = Transaction::STATUS_ACTIVE;
        
        return ($model->save()) ? $model : null;
        
    }
}
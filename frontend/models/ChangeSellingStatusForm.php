<?php
namespace frontend\models;

use common\models\Selling;
use common\components\RModel;
/**
 * ChangeSellingStatusForm model
 *
 */
class ChangeSellingStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $selling_id;

    public $status;

    public $selling;
    
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['selling_id' , 'integer'],
            ['selling_id', 'required'],
            ['selling_id', 'checkExist'],
            
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function checkExist() {
        $this->selling = Selling::find()->where(['id' => $this->selling_id])->one();
        if(!$this->selling) {
            return $this->addError('selling', 'Selling does not exist');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        if($this->selling->status != $this->status) {
            $this->selling->status = $this->status;
            return $this->selling->update();
        }
        return true;
    }

}
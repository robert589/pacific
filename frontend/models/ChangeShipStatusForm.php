<?php
namespace frontend\models;

use common\models\Ship;
use common\components\RModel;
/**
 * ChangeShipStatusForm model
 *
 */
class ChangeShipStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $ship_id;

    public $status;
    
    private $ship;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['ship_id' , 'integer'],
            ['ship_id', 'required'],
            ['ship_id', 'checkExist'],
            
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function checkExist() {
        $this->ship = Ship::find()->where(['id' => $this->ship_id])->one();
        if(!$this->ship) {
            return $this->addError('ship_id', 'Ship does not exist');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        if($this->ship->status != $this->status) {
            $this->ship->status = $this->status;
            return $this->ship->update();
        }
        return true;
    }
}
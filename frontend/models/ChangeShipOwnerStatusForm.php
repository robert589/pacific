<?php
namespace frontend\models;

use common\models\ShipOwner;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * ChangeShipOwnerStatusForm model
 *
 */
class ChangeShipOwnerStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $owner_id;

    public $ship_id;

    public $status;
    
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required'],
            
            ['owner_id', 'integer'],
            ['owner_id', 'required'],
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = $this->getShipOwner();
        if(!$model) {
            $model = new ShipOwner();
            $model->ship_id = $this->ship_id;
            $model->owner_id = $this->owner_id;
            $model->status = $this->status;
            return $model->save();
        }
        
        if($model->status != $this->status) {
            $model->status = $this->status;
            return $model->update();
        }
        
        return true;
        
    }
    
    
    private function getShipOwner() {
        return ShipOwner::find()->where(['ship_id' => $this->ship_id, 'owner_id' => $this->owner_id])->one();
    }
}
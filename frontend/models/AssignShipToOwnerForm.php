<?php
namespace frontend\models;

use common\models\ShipOwner;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * AssignShipToOwnerForm model
 *
 */
class AssignShipToOwnerForm extends RModel
{

    //attributes
    public $user_id;

    public $ship_id;

    public $owner_id;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['ship_id', 'integer'],
            ['ship_id', 'required'],
            
            ['owner_id', 'integer'],
            ['owner_id', 'required']
        ];
    }
    
    public function assign() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = new ShipOwner();
        $model->ship_id = $this->ship_id;
        $model->owner_id = $this->owner_id;
        $model->status = ShipOwner::STATUS_ACTIVE;
        return $model->save();
        
    }

}
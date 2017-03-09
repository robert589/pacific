<?php
namespace frontend\models;

use common\models\EntityOwner;
use common\components\RModel;
/**
 * RemoveOwnerFromEntityForm model
 *
 */
class RemoveOwnerFromCodeForm extends RModel
{

    //attributes
    public $user_id;

    public $entity_id;

    public $target_user_id;
    
    
    public function init() {
        
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required'],
            
            ['target_user_id', 'integer'],
            ['target_user_id', 'required']
        ];
    }
    
    public function remove() {
        if(!$this->validate()) {
            return null;
        }
        
        $entityOwner = $this->findEntityOwner();
        if(!$entityOwner) {
            return true;
        }
        
        if(intval($entityOwner->status) === EntityOwner::STATUS_DELETED ) {
            return true;
        }
        
        $entityOwner->status = EntityOwner::STATUS_DELETED;
        
        return $entityOwner->update();
    }
    
    private function findEntityOwner() {
        return EntityOwner::find()
                ->where(['owner_id' => $this->target_user_id, 'entity_id' => $this->entity_id])->one();
    }



}
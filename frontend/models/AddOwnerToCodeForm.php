<?php
namespace frontend\models;

use common\models\EntityOwner;
use common\components\RModel;
/**
 * AddOwnerToCodeForm model
 *
 */
class AddOwnerToCodeForm extends RModel
{

    //attributes
    public $target_user_id;

    public $user_id;

    public $entity_id;
    
    
    public function init() {
        
    }
    
    public function rules() {
        return [
            ['target_user_id', 'integer'],
            ['target_user_id', 'required'],
            
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['entity_id', 'integer'],
            ['entity_id', 'required']
        ];
    }
    
    
    public function add() {
        if(!$this->validate()) {
            return null;
        }
        
        $entityOwner = $this->findEntityOwner();
        if($entityOwner && intval($entityOwner->status) === intval(EntityOwner::STATUS_ACTIVE)) {
            return true;
        }
        
        if($entityOwner && intval($entityOwner->status) !== intval(EntityOwner::STATUS_ACTIVE)) {
            $entityOwner->status = EntityOwner::STATUS_ACTIVE;
            return $entityOwner->update();
        }
        
        $entityOwner = new EntityOwner();
        $entityOwner->owner_id = $this->target_user_id;
        $entityOwner->entity_id = $this->entity_id;
        $entityOwner->status = EntityOwner::STATUS_ACTIVE;
        return $entityOwner->save();
    }
    
    private function findEntityOwner() {
        return EntityOwner::find()
                ->where(['owner_id' => $this->target_user_id, 'entity_id' => $this->entity_id])->one();
    }
}   
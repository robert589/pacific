<?php
namespace frontend\models;

use common\models\EntityOwner;
use common\models\EntityRelation;
use common\components\RModel;
/**
 * RemoveAllEntityRelationsForm model
 *
 */
class RemoveAllEntityRelationsForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkAC'],
            
            ['code', 'integer'],
            ['code', 'required'],
            
        ];
    }
    
    
    public function checkAC() {
        $allowed = EntityOwner::checkAccessControl($this->user_id, $this->code);
        if(!$allowed) {
            return $this->addError('user_id', 'Not allowed!');
        }
    }
    
    public function removeAll() {
        if(!$this->validate()) {
            return false;
        }
        
        EntityRelation::updateAll(
                ['status' => EntityRelation::STATUS_DELETED], 
                'parent_entity_id = ' . $this->code . ' AND status = ' . EntityRelation::STATUS_ACTIVE);
        
        return true;

    }
    
}
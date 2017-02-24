<?php
namespace frontend\models;

use common\components\RModel;
use common\models\EntityOwner;
use common\models\EntityRelation;
/**
 * RemoveRelationForm model
 *
 */
class RemoveEntityRelationForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public $subcode;

    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkAC'],
            
            ['code', 'integer'],
            ['code', 'required'],
            
            ['subcode', 'integer'],
            ['subcode', 'required'],
            
            ['subcode', 'isNotEqual']
            
        ];
    }
    
    public function isNotEqual() {
        if($this->code === $this->subcode) {
            return $this->addError('subcode', 'Kode cannot be equal with Subcode');
        }
    }
    
    public function checkAC() {
        $allowed = EntityOwner::checkAccessControl($this->user_id, $this->code);
        if(!$allowed) {
            return $this->addError('user_id', 'Not allowed!');
        }
    }
    
    public function remove() {
        if(!$this->validate()) {
            return false;
        }
        
        $entityRelation = $this->getEntityRelation();
        if(!$entityRelation) {
            return true;
        }
        
        if($entityRelation->status === EntityRelation::STATUS_DELETED) {
            return true;
        }
        
        $entityRelation->status = EntityRelation::STATUS_DELETED;
        return $entityRelation->update();
    }
    
    public function getEntityRelation() {
        return EntityRelation::find()->where(['parent_entity_id' => $this->code, 
                                            'child_entity_id' => $this->subcode])->one();
    }
}
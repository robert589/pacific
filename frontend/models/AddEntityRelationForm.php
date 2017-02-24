<?php
namespace frontend\models;

use common\models\EntityOwner;
use common\libraries\UserLibrary;
use common\models\EntityRelation;
use common\components\RModel;
/**
 * AddEntityRelationForm model
 *
 */
class AddEntityRelationForm extends RModel
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
            ['subcode', 'required']
            
            
        ];
    }
    
    public function checkAC() {
        $allowed = EntityOwner::checkAccessControl($this->user_id, $this->code);
        if(!$allowed) {
            return $this->addError('user_id', 'Not allowed!');
        }
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $entityRelation = $this->getEntityRelation();
        if(!$entityRelation) {
            $entityRelation = new EntityRelation();
            $entityRelation->parent_entity_id = $this->code;
            $entityRelation->child_entity_id = $this->subcode;
            $entityRelation->status  = EntityRelation::STATUS_ACTIVE;
            return $entityRelation->save();
        }
        
        if($entityRelation->status === EntityRelation::STATUS_ACTIVE) {
            return true;
        }
        
        $entityRelation->status = EntityRelation::STATUS_ACTIVE;
        return $entityRelation->update();
    }
    
    public function getEntityRelation() {
        return EntityRelation::find()->where(['parent_entity_id' => $this->code, 
                                            'child_entity_id' => $this->subcode])->one();
    }

}
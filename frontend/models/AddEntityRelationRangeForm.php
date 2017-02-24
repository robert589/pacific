<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Entity;
use common\models\EntityOwner;
use common\models\EntityRelation;
/**
 * AddEntityRelationRangeForm model
 *
 */
class AddEntityRelationRangeForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public $from;

    public $to;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkAC'],
            
            ['code', 'integer'],
            ['code', 'required'],
            
            ['from', 'integer'],
            ['from', 'required'],
            
            ['to', 'integer'],
            ['to', 'required'],
            
            ['to', 'isToLargerThanFrom']
        ];
    }
    
    public function isToLargerThanFrom() {
        if(intval($this->from) >= intval($this->to)) {
            return $this->addError("to", "From cannot be larger than to");
        }
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
        
        for($code = $this->from; $code <= $this->to; $code++)  {
            $id = $this->getEntityId($code);
            
            if($id && intval($id) !== intval($this->code)) {
                if(!$this->createRelation($id)) {
                    return false;
                }    
            }
            
        }
        
        return true;
    }
    
    public function getEntityId($code) {
        return Entity::find()->where(['code' => $code])->one()['id'];
    }
    
    public function createRelation($id) {
        
        $entityRelation = $this->getEntityRelation($id);
        if(!$entityRelation) {
            $entityRelation = new EntityRelation();
            $entityRelation->parent_entity_id = $this->code;
            $entityRelation->child_entity_id = $id;
            $entityRelation->status  = EntityRelation::STATUS_ACTIVE;
            return $entityRelation->save();
        }
        
        if($entityRelation->status === EntityRelation::STATUS_ACTIVE) {
            return true;
        }
        
        $entityRelation->status = EntityRelation::STATUS_ACTIVE;
        return $entityRelation->update();
    }
    
    public function getEntityRelation($id) {
        return EntityRelation::find()->where(['parent_entity_id' => $this->code, 
                                            'child_entity_id' => $id])->one();
    }

}
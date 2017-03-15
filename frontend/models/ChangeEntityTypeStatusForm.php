<?php
namespace frontend\models;

use common\models\EntityType;
use common\components\RModel;
/**
 * ChangeEntityTypeStatusForm model
 *
 */
class ChangeEntityTypeStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $entity_type_id;

    public $status;
    
    private $entityType;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['entity_type_id' , 'integer'],
            ['entity_type_id', 'required'],
            ['entity_type_id', 'getEntityType'],
            ['entity_type_id', 'isDeletable'],
            
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function isDeletable() {
        if($this->status === EntityType::STATUS_DELETED &&
                intval($this->entityType->deletable) === 0) {
            return $this->addError("status", "You cannot delete this entity type");
        }
    }
    
    public function getEntityType() {
        $this->entityType = EntityType::find()->where(['id' => $this->entity_type_id])->one();
        if(!$this->entityType) {
            return $this->addError('entity_type_id', 'Entity does not exist');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        if($this->entityType->status == $this->status) {
            return false;
        }
        
        
        $this->entityType->status = $this->status;
          
        return $this->entityType->update();
        
    }

}
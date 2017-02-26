<?php
namespace frontend\models;

use common\components\RModel;
use common\libraries\UserLibrary;
use common\models\Admin;
use common\models\Entity;
use common\models\EntityOwner;
use common\models\Owner;
/**
 * EditEntityForm model
 *
 */
class EditEntityForm extends RModel
{

    //attributes
    public $user_id;

    public $name;

    public $description;

    public $type_id;

    public $code;

    public $id;
    
    
    private $entity;
    
    public function rules() {
        return [
            ['id', 'integer'],
            ['id', 'required'],
            ['id', 'checkExist'],
            
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkOwnership'],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
            
            ['type_id', 'integer'],
            ['type_id', 'required'],
            
            ['code', 'integer'],
            ['code', 'required'],
            ['code', 'isNewCodeDuplicate']

        ];
    }
    
    public function isNewCodeDuplicate() {
        if(intval($this->entity->code) === intval($this->code)) {
            return;
        }
        $entity = Entity::find()->where(['code' => $this->code])->one();
        if($entity) {
            return $this->addError('code', 'This code has been used by: ' . $entity->name);
        }
    }
    
    public function checkExist() {
        $this->entity = Entity::find()->where(['id' => $this->id])->one();
        if(!$this->entity) {
            return $this->addError('id', 'Entity does not exist');
        }
    }
    
    public function checkOwnership() {
        $role = UserLibrary::getRole();
        if($role === Admin::GET_ROLE) {
            return true;
        } 
        else if($role === Owner::GET_ROLE) {
            return EntityOwner::find()->where(['owner_id' => $this->user_id, 'entity_id' => $this->id])->exists();
        }
        
        $this->addError('user_id', 'You are not allowed');
    }
    
    public function edit() {
        if(!$this->validate()) {
            return false;
        }
        
        $this->entity->code = $this->code;
        $this->entity->type_id = $this->type_id;
        $this->entity->name = $this->name;
        $this->entity->status = Entity::STATUS_ACTIVE;
        $this->entity->description = $this->description;
        return $this->entity->update();
    }
}
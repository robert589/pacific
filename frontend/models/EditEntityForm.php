<?php
namespace frontend\models;

use frontend\constants\SellingConstants;
use common\models\EntitySellingUnit;
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
    
    public $unit;
    
    public $in_inventory;
    
    private $entity;
    
    private $entitySellingUnit;
    
    public function rules() {
        return [
            ['id', 'integer'],
            ['id', 'required'],
            ['id', 'getEntity'],
            
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'checkOwnership'],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
            
            ['in_inventory', 'boolean'],
            ['in_inventory', 'required'],
            
            ['type_id', 'integer'],
            ['type_id', 'required'],
            
            ['code', 'integer'],
            ['code', 'required'],
            ['code', 'isNewCodeDuplicate'],
            
            ['unit', 'string']

        ];
    }
    
    public function isNewCodeDuplicate() {
        $duplicateEntityName = Entity::getDuplicateEntityName($this->id, $this->code);
        if($duplicateEntityName) {
            return $this->addError('code', 'This code has been used by: ' . $duplicateEntityName);
        }
    }
    
    public function getEntity() {
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
        $this->entity->in_inventory = $this->in_inventory;
        $this->entity->status = Entity::STATUS_ACTIVE;
        $this->entity->description = $this->description;
        $this->entity->update();

        $this->entitySellingUnit = EntitySellingUnit::find()->where(['entity_id' => $this->id])->one();
        if($this->unit === SellingConstants::DEFAULT_UNIT || !$this->unit) {
            //no need to store if it is the same
            if($this->entitySellingUnit) {
                return EntitySellingUnit::deleteAll("entity_id=" . $this->id);   
            } 
            else {
                return true;
            }
        }
        
        if(!$this->entitySellingUnit) {
            $this->entitySellingUnit = new EntitySellingUnit();
            $this->entitySellingUnit->entity_id = $this->id;    
            $this->entitySellingUnit->unit = $this->unit;
            return $this->entitySellingUnit->save();
        }
        
        if($this->entitySellingUnit->unit !== $this->unit ) {
            $this->entitySellingUnit->unit = $this->unit;
            return $this->entitySellingUnit->update();   
        }

        return true;
    }
}
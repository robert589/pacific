<?php
namespace frontend\models;

use common\models\Entity;
use common\components\RModel;
/**
 * ChangeEntityStatusForm model
 *
 */
class ChangeEntityStatusForm extends RModel
{

    //attributes
    public $user_id;

    public $entity_id;

    public $status;

    public $entity;
    
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['entity_id' , 'integer'],
            ['entity_id', 'required'],
            ['entity_id', 'checkExist'],
            
            ['status', 'integer'],
            ['status', 'required']
        ];
    }
    
    public function checkExist() {
        $this->entity = Entity::find()->where(['id' => $this->entity_id])->one();
        if(!$this->entity) {
            return $this->addError('entity_id', 'Entity does not exist');
        }
    }
    
    public function change() {
        if(!$this->validate()) {
            return false;
        }
        if($this->entity->status != $this->status) {
            $this->entity->status = $this->status;
            return $this->entity->update();
        }
        return true;
    }

}
<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Entity;
use common\validators\IsAdminValidator;
/**
 * CreateCodeForm model
 *
 */
class CreateCodeForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public $name;

    public $description;

    public $type_id;

    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
            
            ['type_id', 'integer'],
            ['type_id', 'required'],
            
            ['code', 'integer'],
            ['code', 'required'],
            ['code', 'unique', 'targetClass' => '\common\models\Entity', 'message' => 'This id has already been taken.'],

        ];
    }
    
    public function create() {
        if(!$this->validate()) {
            return false;
        }
        
        $entity = new Entity();
        $entity->code = $this->code;
        $entity->type_id = $this->type_id;
        $entity->name = $this->name;
        $entity->status = Entity::STATUS_ACTIVE;
        $entity->description = $this->description;
        return $entity->save();
    }

}
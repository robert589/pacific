<?php
namespace frontend\models;

use common\models\EntityType;
use common\components\RModel;
use common\models\Entity;
use common\validators\IsAdminValidator;
use frontend\constants\Constants;
use common\models\Warehouse;
/**
 * AddWarehouseForm model
 *
 */
class AddWarehouseForm extends RModel
{

    //attributes
    public $user_id;

    public $name;

    public $code;

    public $description;

    public $location;

    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
            
            ['location', 'string'],
            
            ['code', 'integer'],
            ['code', 'required'],
            ['code', 'unique', 'targetClass' => '\common\models\Entity', 'message' => 'This id has already been taken.'],

        ];
    }
    
    public function create() {
        if(!$this->validate()) {
            return null;
        }
        
        $entity = new Entity();
        $entity->code = $this->code;
        $entity->type_id = EntityType::find()->where(['name' => Constants::ENTITY_TYPE_WAREHOUSE_NAME])->one()['id'];
        $entity->name = $this->name;
        $entity->status = Entity::STATUS_ACTIVE;
        $entity->description = $this->description;
        
        
        if(!$entity->save()) {
            return null;
        }
        
        $warehouse = new Warehouse();
        $warehouse->location = $this->location;
        return $warehouse->save();
    }

}
<?php
namespace frontend\models;

use common\validators\IsAdminValidator;
use common\models\Warehouse;
use common\models\Entity;
use common\components\RModel;
/**
 * EditWarehouseForm model
 *
 */
class EditWarehouseForm extends RModel
{

    //attributes
    public $user_id;

    public $id;

    public $name;

    public $code;

    public $description;

    /**
     *
     * @var string 
     */
    public $location;
    
    /**
     *
     * @var bool 
     */
    public $selling_place;
    
    /**
     *
     * @var Warehouse
     */
    private $warehouse;
    
    /**
     *
     * @var Entity 
     */
    private $entity;
    
    public function rules() {
        return [
            ['id', 'integer'],
            ['id', 'required'],
            ['id', 'getEntity'],
            ['id', 'getWarehouse'],
            
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
            
            ['location', 'string'],
            
            ['code', 'integer'],
            ['code', 'required'],
            ['code', 'isNewCodeDuplicate'],
            
            ['selling_place', 'boolean'],
            ['selling_place', 'required']

        ];
    }

    public function isNewCodeDuplicate() {
        $duplicateEntityName = Entity::getDuplicateEntityName($this->id, $this->code);
        if($duplicateEntityName) {
            return $this->addError('code', 'This code has been used by: ' . $duplicateEntityName);
        }
    }
    
    public function getEntity() {
        $this->entity = Entity::find()->where(['id' => $this->id, 'status' => Entity::STATUS_ACTIVE])->one();
        if(!$this->entity) {
            return $this->addError('id', 'Not a warehouse');
        }
    }
    
    public function getWarehouse() {
        $this->warehouse = Warehouse::find()->where(['id' => $this->id])->one();
        if(!$this->warehouse) {
            return $this->addError('id', 'Not a warehouse');
        }
    }
    
    public function edit() {
        if(!$this->validate()) {
            return null;
        }
        
        $this->entity->code = $this->code;
        $this->entity->name = $this->name;
        $this->entity->description = $this->description;
        $this->entity->update();
        
        $this->warehouse->location = $this->location;
        $this->warehouse->selling_place = $this->selling_place;
        $this->warehouse->update();
        
        return true;
    }
}
<?php
namespace frontend\models;

use common\models\EntityType;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * EditCodeTypeForm model
 *
 */
class EditCodeTypeForm extends RModel
{

    //attributes
    public $user_id;

    public $entity_type_id;

    public $name;

    public $description;
    
    private $entityType;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string'],
            
            ['entity_type_id', 'integer'],
            ['entity_type_id', 'getEntityType']
        ];
        
    }
    
    public function getEntityType() {
        $this->entityType = EntityType::find()->where(['id' => $this->entity_type_id])->one();
        if(!$this->entityType) {
            return $this->addError('entity_type_id','Entity Type does not exist');
        }
    }
    
    public function edit( ) {
        if(!$this->validate()) {
            return false;
        }
        
        $this->entityType->name = $this->name;
        $this->entityType->description = $this->description;
        $this->entityType->update();
        return true;
        
    }

}
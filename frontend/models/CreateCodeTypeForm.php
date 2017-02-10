<?php
namespace frontend\models;

use common\components\RModel;
use frontend\vos\EntityTypeVo;
use common\validators\IsAdminValidator;
use common\models\EntityType;
use common\models\Entity;
/**
 * CreateCodeTypeForm model
 *
 */
class CreateCodeTypeForm extends RModel
{

    //attributes
    public $user_id;

    public $name;

    public $description;

    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['description', 'string']
        ];
    }
    
    public function create( ) {
        if(!$this->validate()) {
            return false;
        }
        
        $ship = new EntityType();
        $ship->name = $this->name;
        $ship->description = $this->description;
        $ship->status = EntityType::STATUS_ACTIVE;
        return $ship->save();
    }

}
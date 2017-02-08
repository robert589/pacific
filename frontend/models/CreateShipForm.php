<?php
namespace frontend\models;

use common\models\Ship;
use common\components\RModel;
use common\validators\IsAdminValidator;
/**
 * CreateShipForm model
 *
 */
class CreateShipForm extends RModel
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
        
        $ship = new Ship();
        $ship->name = $this->name;
        $ship->description = $this->description;
        $ship->status = Ship::STATUS_ACTIVE;
        return $ship->save();
    }
}
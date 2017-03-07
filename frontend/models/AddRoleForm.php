<?php
namespace frontend\models;

use common\models\Role;
use common\validators\IsAdminValidator;
use common\components\RModel;
/**
 * AddRoleForm model
 *
 */
class AddRoleForm extends RModel
{

    //attributes
    public $user_id;

    public $name;

    public $description;
    
    public function init() {
        
    }
    
    public function rules() {
        return 
        [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['name', 'string'], 
            ['name', 'required'],
            
            ['description', 'string']
                
        ];
    }
    
    public function add() {
        if(!$this->validate()) {
            return null;
        }
        
        $role = new Role();
        $role->name = $this->name;
        $role->description = $this->description;
        $role->status = Role::STATUS_ACTIVE;
        return $role->save();
    }
}
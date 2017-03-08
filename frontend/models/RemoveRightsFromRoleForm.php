<?php
namespace frontend\models;

use common\components\RModel;
use common\models\RoleAccessControl;
/**
 * RemoveRightsFromRoleForm model
 *
 */
class RemoveRightsFromRoleForm extends RModel
{

    //attributes
    public $user_id;

    public $role_id;

    public $access_control_id;
    
    public function init() {
        
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['role_id', 'integer'],
            ['role_id', 'required'],
            
            ['access_control_id', 'integer'],
            ['access_control_id', 'required']
        ];
    }
    
    public function remove() {
        if(!$this->validate()) {
            return null;
        }
        
        $roleAccessControl = $this->findRoleAccessControl();
        if(!$roleAccessControl) {
            return true;
        }
        
        if(intval($roleAccessControl->status) === intval(RoleAccessControl::STATUS_DELETED) ) {
            return true;
        }
        
        $roleAccessControl->status = RoleAccessControl::STATUS_DELETED;
        
        return $roleAccessControl->update();
    }
    
    private function findRoleAccessControl() {
        return RoleAccessControl::find()->where(['access_control_id' => $this->access_control_id, 'role_id' => $this->role_id])->one();
    }

}
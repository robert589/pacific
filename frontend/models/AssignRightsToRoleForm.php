<?php
namespace frontend\models;

use common\components\RModel;
use common\models\RoleAccessControl;
/**
 * AssignRightsToRoleForm model
 *
 */
class AssignRightsToRoleForm extends RModel
{

    //attributes
    public $user_id;

    public $role_id;

    public $access_control_id;

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
    
    public function assign() {
        if(!$this->validate()) {
            return null;
        }
        
        $roleAccessControl = $this->findRoleAccessControl();
        if($roleAccessControl && intval($roleAccessControl->status) === intval(RoleAccessControl::STATUS_ACTIVE)) {
            return true;
        }
        
        if($roleAccessControl && intval($roleAccessControl->status) !== intval(RoleAccessControl::STATUS_ACTIVE)) {
            $roleAccessControl->status = RoleAccessControl::STATUS_ACTIVE;
            return $roleAccessControl->update();
        }
        
        $roleAccessControl = new RoleAccessControl();
        $roleAccessControl->access_control_id = $this->access_control_id;
        $roleAccessControl->role_id = $this->role_id;
        $roleAccessControl->status = RoleAccessControl::STATUS_ACTIVE;
        return $roleAccessControl->save();
    }
    
    private function findRoleAccessControl() {
        return RoleAccessControl::find()->where(['role_id' => $this->role_id, 
                                        'access_control_id' => $this->access_control_id])->one();
    }
}
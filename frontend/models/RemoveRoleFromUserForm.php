<?php
namespace frontend\models;

use common\components\RModel;
use common\models\UserRole;
/**
 * RemoveRoleFromUserForm model
 *
 */
class RemoveRoleFromUserForm extends RModel
{

    //attributes
    public $user_id;

    public $role_id;

    public $target_user_id;

    public function init() {
        
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['role_id', 'integer'],
            ['role_id', 'required'],
            
            ['target_user_id', 'integer'],
            ['target_user_id', 'required']
        ];
    }
    
    public function remove() {
        if(!$this->validate()) {
            return null;
        }
        
        $userRole = $this->findUserRole();
        if(!$userRole) {
            return true;
        }
        
        if(intval($userRole->status) === UserRole::STATUS_DELETED ) {
            return true;
        }
        
        $userRole->status = UserRole::STATUS_DELETED;
        
        return $userRole->update();
    }
    
    private function findUserRole() {
        return UserRole::find()->where(['user_id' => $this->target_user_id, 'role_id' => $this->role_id])->one();
    }

}
<?php
namespace frontend\models;

use common\models\UserRole;
use common\components\RModel;
/**
 * AddRoleToUserForm model
 *
 */
class AddRoleToUserForm extends RModel
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
    
    public function add() {
        if(!$this->validate()) {
            return null;
        }
        
        $userRole = $this->findUserRole();
        if($userRole && intval($userRole->status) === intval(UserRole::STATUS_ACTIVE)) {
            return true;
        }
        
        if($userRole && intval($userRole->status) !== intval(UserRole::STATUS_DELETED)) {
            $userRole->status = UserRole::STATUS_ACTIVE;
            return $userRole->update();
        }
        
        $userRole = new UserRole();
        $userRole->user_id = $this->target_user_id;
        $userRole->role_id = $this->role_id;
        $userRole->status = UserRole::STATUS_ACTIVE;
        return $userRole->save();
    }
    
    private function findUserRole() {
        return UserRole::find()->where(['user_id' => $this->target_user_id, 'role_id' => $this->role_id])->one();
    }
}
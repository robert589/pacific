<?php
namespace frontend\daos;

use common\models\Admin;
use frontend\vos\AccessControlVo;
use common\models\Owner;
use Yii;
use common\models\Role;
use frontend\vos\RoleVo;
use frontend\vos\UserVo;
use common\components\Dao;
/**
 * UserDao class
 */
class UserDao implements Dao
{
    const GET_USER_LIST = "SELECT user.* from user";
    
    const GET_ROLE_LIST = "select role.* from role";
    
    const GET_ROLE = "SELECT (owner.id is not null) as :owner,
                             (admin.id is not null )as :admin
                       FROM user
                       left join owner
                       on user.id = owner.id
                       left join admin
                       on user.id = admin.id
                       where user.id = :user_id";
    
    const GET_ROLES = "select role.*
                        from role, user_role
                        where role.id = user_role.role_id and 
                            user_role.user_id = :user_id and
                            user_role.status = :role_status";
    
    const GET_RIGHTS_FOR_ROLE = "select access_control.*
                        from access_control, role_access_control
                        where access_control.id = role_access_control.access_control_id and 
                            role_access_control.role_id = :role_id and
                            role_access_control.status = :role_ac_status";
    
    const SEARCH_ROLE = "SELECT role.*
                        from role 
                         where role.name LIKE :query
                         limit 4";
                         
    const SEARCH_RIGHTS = "select access_control.*
                            from access_control
                            where access_control.code LIKE :query  or access_control.name LIKE :query
                            limit 4";
    
    public function searchRole($q) {
        $q = '%' . $q . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_ROLE)
            ->bindParam(':query', $q)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = AccessControlVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function searchRights($q) {
        $q = '%' . $q . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_RIGHTS)
            ->bindParam(':query', $q)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = RoleVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function getRoles($userId, $roleStatus = Role::STATUS_ACTIVE) {
        $results = \Yii::$app->db
             ->createCommand(self::GET_ROLES)
             ->bindParam(':role_status', $roleStatus)
             ->bindParam(':user_id', $userId)
             ->queryAll();
        
        $vos = [];

        foreach($results as $result) {
            $builder = RoleVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        
        return $vos;
    }
    
    public function getRightsForRole($roleId, $roleAcStatus = Role::STATUS_ACTIVE) {
        $results = \Yii::$app->db
             ->createCommand(self::GET_RIGHTS_FOR_ROLE)
             ->bindParam(':role_ac_status', $roleAcStatus)
             ->bindParam(':role_id', $roleId)
             ->queryAll();
        
        $vos = [];

        foreach($results as $result) {
            $builder = AccessControlVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function getRole($userId) {
          $admin =  Admin::GET_ROLE;
          $owner = Owner::GET_ROLE;
          $result = \Yii::$app->db
             ->createCommand(self::GET_ROLE)
             ->bindParam(':admin', $admin)
             ->bindParam(':owner', $owner)
             ->bindParam(':user_id', $userId)
             ->queryOne();
         
         foreach($result as $index => $value) {
             if($value) {
                 return $index;
            } 
         } 
         
         return null;
     }
     
     public function hasRole($userId, $roleName) {
         $admin =  Admin::GET_ROLE;
         $owner = Owner::GET_ROLE;
         $result = \Yii::$app->db
             ->createCommand(self::GET_ROLE)
             ->bindParam(':admin', $admin)
             ->bindParam(':owner', $owner)
             ->bindParam(':user_id', $userId)
             ->queryOne();
         
         return $result[$roleName] == 1;
         
     }    
    
    public function getUserList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_USER_LIST)
            ->queryAll();
            
        $vos = [];
        foreach($results as $result) {
            $builder = UserVo::createBuilder();
            $builder->loadData($result);
            $builder->setRoles($this->getRoles($builder->getId()));
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function getRoleList() {
        $results = \Yii::$app->db
            ->createCommand(self::GET_ROLE_LIST)
            ->queryAll();
            
        $vos = [];
        foreach($results as $result) {
            $builder = RoleVo::createBuilder();
            $builder->loadData($result);
            $builder->setRights($this->getRightsForRole($builder->getId()));
        
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    
}


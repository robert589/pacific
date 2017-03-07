<?php
namespace frontend\daos;

use common\models\Admin;
use common\models\Owner;
use Yii;
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
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    
}


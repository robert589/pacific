<?php
namespace frontend\daos;

use Yii;
use common\models\Admin;
use common\models\Owner;
use common\components\Dao;
/**
 * UserDao class
 */
class UserDao implements Dao
{

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
}


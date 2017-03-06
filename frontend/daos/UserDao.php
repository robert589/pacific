<?php
namespace frontend\daos;

use Yii;
use frontend\vos\UserVo;
use common\components\Dao;
/**
 * UserDao class
 */
class UserDao implements Dao
{
    const GET_USER_LIST = "SELECT user.* from user";
    
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
}


<?php
namespace frontend\daos;

use Yii;
use common\models\User;
use frontend\vos\OwnerVo;
use frontend\vos\UserVo;
use common\components\Dao;
/**
 * OwnerDao class
 */
class OwnerDao implements Dao
{
    const GET_ALL_OWNERS = "SELECT user.first_name as user_first_name, 
                                    user.id as user_id, 
                                    user.last_name as user_last_name,
                                    user.telephone as user_telephone,
                                    user.address as user_address
                            from owner,user
                            where owner.id = user.id ";
    
    const SEARCH_OWNERS = "SELECT user.first_name as user_first_name, 
                                    user.id as user_id, 
                                    user.last_name as user_last_name,
                                    user.telephone as user_telephone,
                                    user.address as user_address
                            from owner,user
                            where owner.id = user.id and 
                                (user.first_name LIKE :query or user.last_name LIKE :query or
                                        concat(user.first_name, ' ', user.last_name) LIKE :query) and
                                        user.status = :status";
    
    public function searchOwners($q, $status = User::STATUS_ACTIVE) {
        $q = '%' . $q . '%';
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_OWNERS)
            ->bindParam(':query', $q)
            ->bindParam(':status', $status)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = OwnerVo::createBuilder();
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result, "user");
            $builder->setUser($userBuilder->build());
            $vos[] = $builder->build();
        }
        return $vos;    
    }
    
    public function getAllOwners() {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ALL_OWNERS)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = OwnerVo::createBuilder();
            
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result, "user");
            $builder->setUser($userBuilder->build());
            
            $vos[] = $builder->build();
        }
        return $vos;
    
    }
    

}


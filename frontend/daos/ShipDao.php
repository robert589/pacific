<?php
namespace frontend\daos;

use Yii;
use common\models\Ship;
use common\components\Dao;
use common\models\ShipOwner;
use frontend\vos\OwnerVo;
use frontend\vos\UserVo;
use frontend\vos\ShipVo;
/**
 * ShipDao class
 */
class ShipDao implements Dao
{
    const GET_ALL_SHIPS = "SELECT *
                            from ship where ship.status = :status";
    
    const SEARCH_SHIPS = "SELECT *
                            from ship
                            where ship.name like :query and ship.status = :status";
    
    const GET_SHIP_OWNERSHIP = "select user.first_name as user_first_name, user.last_name as user_last_name,
                                        user.id as user_id
                                from owner, user, ship_owner
                                where ship_owner.ship_id = :ship_id and ship_owner.owner_id = owner.id
                                    and owner.id = user.id and ship_owner.status = :status";
    
    public function getShipOwnership($shipId, $status = ShipOwner::STATUS_ACTIVE) {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_SHIP_OWNERSHIP)
            ->bindParam(":ship_id", $shipId)
            ->bindParam(":status", $status)
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
    
    public function searchShips($q) {
        $q = '%' . $q . '%';
        $status = Ship::STATUS_ACTIVE;
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_SHIPS)
            ->bindParam(':query', $q)
            ->bindParam(':status', $status)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = ShipVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }

    public function getAllShips() {
        $status = Ship::STATUS_ACTIVE;
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ALL_SHIPS)
            ->bindParam(':status', $status)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = ShipVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    
    }

    
}

